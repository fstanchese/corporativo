select 
  id,
  classpreview 
from
  BolsaSol
where
  cesjprocsel_id is null
and
  state_id in ( 3000000012008, 3000000012005 )
and
  pletivo_id = nvl( p_PLetivo_Id ,0)
order by pontos
