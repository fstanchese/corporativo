select
  wnota.*
from
  wnota
where
  ( estado = 'CURSANDO' or estado is null )
  and
  wpessoa_id = nvl( p_WPessoa_Id ,0)
