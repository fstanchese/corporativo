select
  Boleto.OrdemRef,
  Boleto.Referencia,
  Boleto.Valor,
  to_char(Boleto.Valor,'999G990D99')        as ValorBoletoFormat,
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
  BoletoTi_id = 92200000000003
and
  Boleto.State_Base_ID != 3000000000001
and
  OrdemRef = nvl ( p_Boleto_OrdemRef , 0 )
and
  WPessoa_Sacado_Id = nvl ( p_WPessoa_Id , 0 )
order by Boleto.Referencia