select
  Max(dtpagto) as dtpagto
from
  Recebimento,
  Boleto
where
  Recebimento.Boleto_Id = Boleto.Id
and
  BoletoTi_Id in ( 92200000000002 , 92200000000003 )
and
  Boleto.WPessoa_Sacado_Id = nvl ( p_WPessoa_Id , 0 )
