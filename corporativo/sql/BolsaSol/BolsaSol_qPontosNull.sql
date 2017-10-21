select
  id,
  bolsasol_gnpontos(id) as pontos
from
  bolsasol
where
  state_id = 3000000012008
and
  pontos is null
and
  CESJProcSel_Id is null
and
  PLetivo_Id = nvl ( p_PLetivo_Id ,0 )
