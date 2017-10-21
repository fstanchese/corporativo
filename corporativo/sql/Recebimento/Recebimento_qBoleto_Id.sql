select
  Boleto.Referencia                                                       as Referencia,
  to_char(Boleto.Valor,'9990D99')                                         as ValorBoleto,
  Boleto.Valor                                                            as Boleto_Valor,
  to_char(Recebimento.Multa,'9990D99')                                    as Multa,
  to_char(Recebimento.Mora,'9990D99')                                     as Mora,
  to_char(Recebimento.Valor,'99990D99')                                   as ValorPago,
  Boleto.NossoNum                                                         as NossoNum,
  Boleto.BoletoTi_Id                                                      as BoletoTi_Id,
  BoletoTi_gsRecognize(Boleto.BoletoTi_Id)                                as BoletoTi_Recognize,
  substr(Boleto.Competencia,5,2) || '/' || substr(Boleto.Competencia,1,4) as Competencia,
  Recebimento.DtPagto                                                     as DtPagto,
  Recebimento.Dt                                                          as Recebimento_Dt,
  Recebimento_gsOrigem(Recebimento.Id)                                    as TpBaixa,
  Recebimento_gsOrigem(Recebimento.Id,'on')                               as TpBaixaAbrev,
  Recebimento.Valor                                                       as ValorRecebido,
  Recebimento.Multa                                                       as Multa_Valor,
  Recebimento.Mora                                                        as Mora_Valor,
  Recebimento.NFERPS                                                      as NFERPS,
  Recebimento.Id                                                          as Recebimento_Id,
  BaixaMTi.Abreviacao                                                     as TpBaixaManual,
  Recebimento.BaixaMTi_Id                                                 as BaixaMTi_Id,
  Boleto_gnBoletoTi(Boleto.Id)                                            as BoletoTi_Origem,
  Recebimento.Parcel_Origem_Id                                            as Parcel_Origem_Id,
  Recebimento.Valor - Boleto_gnValor(Boleto.Id,Recebimento.DtPagto)       as DiferencaValor
from
  Recebimento,
  Boleto,
  BaixaMTi
where
  Recebimento.BaixaMTi_Id = BaixaMTi.Id (+)
and
  Recebimento.Boleto_Id = Boleto.Id
and
  Recebimento.Boleto_Id = p_Boleto_Id 
order by Recebimento_Dt

