select
  Boleto.Referencia,
  Boleto.Valor,
  to_char(Boleto.Valor,'999G999D99')        as ValorBoletoFormat,
  Boleto.Dt                                 as DtEmissao,
  Boleto.DtVencto,
  Boleto.State_Base_Id,
  Boleto.BoletoTi_Id,
  Boleto.NossoNum,
  Recebimento_gsOrigem(Recebimento.Id,'on') as TpBaixa,
  Recebimento.Valor                         as ValorRecebido,
  Boleto.Id                                 as Boleto_Id
from
  Boleto,
  Recebimento
where
  Recebimento.Boleto_Id (+) = Boleto.Id 
and
  To_Char(Boleto.dtVencto,'yyyy') = p_Boleto_OrdemRef 
and
  BoletoTi_Id in (92200000000004, 92200000000005)
and
  WPessoa_Sacado_Id = p_WPessoa_Id 
order by Boleto.BoletoTi_Id, Boleto.Id
