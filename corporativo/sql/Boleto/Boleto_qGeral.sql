select
  *
from
  Boleto
where
  WPessoa_Sacado_Id = nvl( p_WPessoa_Id ,0 )