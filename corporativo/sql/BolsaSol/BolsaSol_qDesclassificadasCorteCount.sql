select
  count(id) as COUNT
from
  BolsaSol
where
  bolsasol_gnDesclassificada(id) = 1
  and
  state_id in ( 3000000012008, 3000000012005 )
  and
  pletivo_id = nvl( p_PLetivo_Id ,0)
