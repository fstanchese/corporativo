select 
  id,
  codigo
from 
  sala
where
  sala.codigo = Upper('$v_search')
