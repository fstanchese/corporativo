select
  Boleto.*
from
  Boleto
where
  Boleto.Id = nvl( p_Boleto_Id ,0)