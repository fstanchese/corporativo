select 
  count(*) as total
from 
  pletivop 
where 
  pletivo_id = nvl ( p_PLetivo_Id , 0 )
and 
  dtgeracao is null