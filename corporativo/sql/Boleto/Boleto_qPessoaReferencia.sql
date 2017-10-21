select
  Boleto.*,
  Boleto_gnState(Boleto.Id)   as State_Id
from
  Boleto
where
  Referencia = p_Boleto_Referencia
and
  WPessoa_Sacado_Id = nvl( p_WPessoa_Id ,0)