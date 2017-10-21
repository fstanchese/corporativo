Tomar cuidado ao recompilar essa query, esta sendo usada no termo de quitação anual.

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
  Boleto.Id                                 as Boleto_Id,
  Recebimento.Parcel_Origem_Id              as Parcel_Id
from
  Boleto,
  Recebimento
where
  Recebimento.Boleto_Id (+) = Boleto.Id 
and
  substr(OrdemRef,1,4) = p_Boleto_OrdemRef 
and
  WPessoa_Sacado_Id = p_WPessoa_Id 
order by Boleto.OrdemRef
