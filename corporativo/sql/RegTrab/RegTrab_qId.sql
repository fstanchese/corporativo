select
  *
from
  RegTrab
where
  id = nvl( p_RegTrab_Id ,0)
