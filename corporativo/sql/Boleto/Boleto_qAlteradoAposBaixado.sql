select
  BoletoHi.Dt                                             as DataAlterado,
  Recebimento.Dt                                          as DataBaixa,
  Boleto.Dt                                               as DtBoleto,
  Boleto.Id                                               as Boleto_Id,
  SubStr(WPessoa_gnCodigo(Boleto.WPessoa_Sacado_Id),1,10) as Codigo,
  SubStr(Boleto.Referencia,1,15)                          as Referencia,
  SubStr(BoletoHi.Old,1,10)                               as Old,
  SubStr(BoletoHi.New,1,10)                               as New,
  Boleto.Valor                                            as BoletoValor,
  BoletoTi_gsRecognize(Boleto.BoletoTi_id)                as BoletoTipo,
  Substr(BoletoHi.Col,1,15)                               as Coluna,
  Case
    When Recebimento.Cnab_Origem_Id Is Not Null Then 'Compensação'
    When Recebimento.PostoBanc_Origem_Id Is Not Null Then 'Posto Bancário'
    When Recebimento.BaixaMTi_Id Is Not Null Then 'Baixa Manual'
    When Recebimento.Parcel_Origem_id is Not Null Then 'Parcelamento'
  End Origem,
  Boleto.NossoNum                                         as NossoNum,
  Boleto.Valor                                            as Valor,
  Recebimento.Valor                                       as ValorPago,
  Recebimento.DtPagto                                     as DtPagto,
  Campus.Nome                                             as Campus
from
  BoletoHi,
  Boleto,
  Recebimento,
  Campus 
where
  Campus.Id = Boleto.Campus_Id
and
  (
    (
      Upper(BoletoHi.Col) = 'COMPETENCIA'
    and
      Boleto.BoletoTi_Id = 92200000000003
    )
  or
    (
      Upper(BoletoHi.Col) = 'DT_VENCTO'
    and
      Boleto.BoletoTi_Id = 92200000000002
    )
  or
    Upper(BoletoHi.Col) = 'VALOR'
  )
and
  Boleto.Id = Recebimento.Boleto_Id 
and
  To_Date(BoletoHi.Dt) > To_Date(Recebimento.Dt)
and
  BoletoHi.Boleto_Id = Recebimento.Boleto_Id
and
  To_Date(BoletoHi.Dt) Between To_Date ( nvl ( p_O_Data1 , sysdate ) ) and To_Date ( nvl ( p_O_Data2 , sysdate ) )
order by 
  Campus, Coluna, BoletoTipo, Origem, DataAlterado