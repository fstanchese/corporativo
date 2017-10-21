select
  * 
from
  wtxServico
where
  id = nvl( p_wtxServico_Id , 0 )
