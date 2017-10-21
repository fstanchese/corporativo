select
  count(id) as COUNT
from
  BolsaSol
where
  bolsasol_gnDesclassificada(id) = 0
  and
  pontos >= nvl( p_BolsaSol_Pontos1 ,0)
  and
  pontos <= nvl( p_BolsaSol_Pontos2 ,0)
  and
  state_id in ( 3000000012008, 3000000012005 )
  and
  pletivo_id = nvl( p_PLetivo_Id ,0)
