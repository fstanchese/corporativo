select
  referencia
from
  Boleto
where
  Id = nvl( p_Boleto_Id ,0)
