select
  pontos
from
  BolsaSol
where
  classpreview = p_BolsaSol_ClassPreview
  and
  state_id in ( 3000000012008, 3000000012005 )
  and
  pletivo_id = nvl( p_PLetivo_Id ,0)
