select
  Recebimento.Id                             as Id,
  Boleto.Referencia || ' - R$' || to_char(Boleto.Valor,'99G990D99') || ' - ' || to_char(Boleto.DtVencto,'dd/mm/yyyy') || ' - ' ||  Boleto.NossoNum as Recognize, 
  Boleto.Referencia                          as Referencia,
  to_char(Boleto.Valor,'9990D99')            as ValorBoleto,
  Boleto.Valor                               as Boleto_Valor,
  to_char(Recebimento.Multa,'9990D99')       as Multa,
  to_char(Recebimento.Mora,'9990D99')        as Mora,
  to_char(Recebimento.Valor,'99990D99')      as ValorPago,
  Boleto.NossoNum                            as NossoNum,
  Boleto.BoletoTi_Id                         as BoletoTi_Id,
  BoletoTi_gsRecognize(Boleto.BoletoTi_Id)   as BoletoTi_Recognize,
  substr(Boleto.Competencia,5,2) || '/' || substr(Boleto.Competencia,1,4) as Competencia,
  Boleto.OrdemRef                            as OrdemRef,
  Recebimento.DtPagto                        as DtPagto,
  Recebimento.Dt                             as Recebimento_Dt,
  Recebimento_gsOrigem(Recebimento.Id)       as TpBaixa,
  Recebimento.Valor                          as ValorRecebido,
  Recebimento.Multa                          as Multa_Valor,
  Recebimento.Mora                           as Mora_Valor
from
  Recebimento,
  Boleto
where
  Recebimento.BaixaMTi_Id = 103700000000008
and
  Recebimento.Boleto_Id = Boleto.Id
and
  WPessoa_Sacado_Id = nvl ( p_WPessoa_Id ,0)
order by 
  OrdemRef