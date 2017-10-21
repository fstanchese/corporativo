select
  Boleto.Campus_Id                                          as Campus_Id,
  count(boleto.id)                                          as QtdBoleto,
  Decode(Boleto_gnBoletoTi( Boleto.Id ), 92200000000003, substr(competencia,5,2) || '/' || substr(competencia,1,4), to_char(boleto.dtvencto, 'mm/yyyy'))   as Competencia,
  to_char(sum(Boleto.valor),'999G999D99')                   as VlrBoletoFormat,
  to_char(sum(Recebimento.valor),'999G999D99')              as VlrRecebidoFormat,
  to_char(sum(Recebimento.mora),'999G999D99')               as VlrMoraFormat,
  to_char(sum(Recebimento.multa),'999G999D99')              as VlrMultaFormat,
  sum(Boleto.valor)                                         as VlrBoleto,
  sum(Recebimento.valor)                                    as VlrRecebido,
  sum(Recebimento.mora)                                     as VlrMora,
  sum(Recebimento.multa)                                    as VlrMulta,
  Campus_gsRecognize(Boleto.Campus_Id)                      as Campus_Recognize,
  Decode(Boleto_gnBoletoTi( Boleto.Id ), 92200000000003, boleto.competencia, to_char(boleto.dtvencto, 'yyyymm')) as CompetenciaOrdem
from
  boleto,
  recebimento,
  parcel,
  parcelbol
where
  Boleto_gnBoletoTi( Boleto.Id ) = p_BoletoTi_Id 
and
  boleto.id = parcelbol.boleto_id
and
  parcel.id=recebimento.parcel_origem_id
and
  recebimento.boleto_id = parcelbol.boleto_id
and
  parcel.id = parcelbol.parcel_Id
and
  parcel.State_Id = 3000000020003
and
  (
    (
      trunc(parcel.dt) between nvl( p_O_Data1 , sysdate ) and nvl ( p_O_Data2 , sysdate )
    and 
      p_Parcel_Id is null
    )
    or
    ( 
      p_Parcel_Id is not null 
    and
      Parcel.Id = p_Parcel_Id
    )
  )
group by boleto.Campus_Id, Decode(  Boleto_gnBoletoTi( Boleto.Id ), 92200000000003, boleto.competencia, to_char(boleto.dtvencto, 'yyyymm')), Decode(Boleto_gnBoletoTi( Boleto.Id ), 92200000000003, substr(competencia,5,2) || '/' || substr(competencia,1,4), to_char(boleto.dtvencto, 'mm/yyyy'))
order by Campus_Recognize, Decode(  Boleto_gnBoletoTi( Boleto.Id ), 92200000000003, boleto.competencia, to_char(boleto.dtvencto, 'yyyymm'))