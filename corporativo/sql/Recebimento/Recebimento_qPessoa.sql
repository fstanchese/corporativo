
select
  Recebimento.id                          as Id,
  Boleto.NossoNum || ' - ' || Boleto.Referencia || ' -> Pagamento: ' || Recebimento.DtPagto || ' - ' || Recebimento.Valor  as recognize,
  Recebimento.DtPagto,
  Boleto.Referencia,
  Recebimento.Valor                       as VlrPago,
  to_char(Recebimento.Valor,'999G999D99') as VlrPagoFormat,
  Recebimento.Parcel_Origem_Id  
from
  Recebimento,
  Boleto
where
  Recebimento.Boleto_Id = Boleto.Id
and
  (
    dtpagto > p_O_Data  
  or
    p_O_Data is null
  )
and
  Boleto.WPessoa_Sacado_Id = p_WPessoa_Id
order by
  Recebimento.DtPagto