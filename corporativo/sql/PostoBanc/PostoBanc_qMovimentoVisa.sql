select
  Tipo_Recognize                                                                                                                       as TIPO_RECOGNIZE, 
  Campus_Recognize                                                                                                                     as CAMPUS_RECOGNIZE,
  To_Char( sum(ValorTransacao) , '99G999G999D99' )                                                                                     as TOTALFORMATADO,
  To_Char( sum(round(ValorTransacao * Decode(TipoTransacao,'pag_VD', 0.02, Decode(Parcelas, '1',0.025,0.035)),2 )), '99G999G999D99' )  as TOTALCOMISSAOFORMATADO,
  sum(ValorTransacao)                                                                                                                  as TOTAL,
  sum(round(ValorTransacao * Decode(TipoTransacao,'pag_VD', 0.02, Decode(Parcelas, '1',0.025,0.035)),2 ))                              as TOTALCOMISSAO
from
  (
  select
    substr(PostoBanc.Transacao,26,1)                                                                                  as Parcelas,
    substr(PostoBanc.Transacao,12,6)                                                                                  as TipoTransacao,
    TempMov.Campus_Recognize                                                                                          as CAMPUS_RECOGNIZE,
    PostoBanc_gsTipoMovimento( null, null, substr(PostoBanc.Transacao,12,6) )                                         as TIPO_RECOGNIZE,
    to_number_def(replace(replace(substr(PostoBanc.transacao,1,10),'_',' '),'.',','))                                 as VALOR,
    TempMov.ValorRec                                                                                                  as VALORREC,
    TempMov.ValorRec * PostoBanc_gnPercentualTipo( PostoBanc.IP , PostoBanc.DtProcessamento , PostoBanc.Transacao )   as VALORTRANSACAO
  from
    (
    select
      PostoBanc.IP                           as IP,
      dtprocessamento                        as DTPROCESSAMENTO,
      Campus_gsRecognize(Boleto.Campus_Id)   as CAMPUS_RECOGNIZE,
      Recebimento.Valor                      as VALORREC
    from
      PostoBanc,
      Recebimento,
      Boleto
    where
      Boleto.Id = Recebimento.Boleto_Id
    and
      Recebimento.PostoBanc_Origem_Id = PostoBanc.Id
    and
      DtProcessamento is not null
    and
      substr(Transacao,12,6) not in ( 'pag_DN', 'pag_CH', 'pag_VD', 'pag_VC' )
    and
      to_date(PostoBanc.Dt) between  to_date ( nvl ( p_O_Data1 , sysdate ) ) and to_date ( nvl ( p_O_Data2 , sysdate ) )
    ) tempmov,
    PostoBanc
  where
    tempmov.IP = PostoBanc.IP
  and
    tempmov.dtprocessamento = PostoBanc.dtprocessamento
  and
    substr(PostoBanc.Transacao,12,6) in ( 'pag_VD', 'pag_VC' )
  and
    to_date(PostoBanc.Dt) between  to_date ( nvl ( p_O_Data1 , sysdate ) ) and to_date ( nvl ( p_O_Data2 , sysdate ) )
  )
group by 
  CAMPUS_RECOGNIZE, TIPO_RECOGNIZE
order by 1,2
 