(
select
  Recebimento.DtPagto  as DtPagto
from
  Boleto,
  Recebimento
where
  Boleto.BoletoTi_Id not in (92200000000004,92200000000006,92200000000007,92200000000008,92200000000013,92200000000005,92200000000011)
and
  Recebimento.Boleto_Id = Boleto.Id 
and
  Recebimento.Parcel_Origem_Id is null
and
  substr(OrdemRef,1,4) = p_Boleto_OrdemRef 
and
  WPessoa_Sacado_Id = p_WPessoa_Id 
)
union
(
select
  Recebimento.DtPagto  as DtPagto
from
  Boleto,
  Recebimento
where
  Boleto.BoletoTi_Id in (92200000000004,92200000000005)
and
  Recebimento.Boleto_Id = Boleto.Id 
and
  to_char(Boleto.DtVencto,'yyyy') = p_Boleto_OrdemRef 
and
  WPessoa_Sacado_Id = p_WPessoa_Id 
)
order by DtPagto desc 
