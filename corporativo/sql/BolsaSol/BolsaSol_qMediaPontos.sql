select 
  to_char(avg( nvl(pontos,0)),'999G990D99') as MEDIA
from 
  BolsaSol
where
  state_id in ( 3000000012008, 3000000012005 )
  and
  pletivo_id = nvl( p_PLetivo_Id ,0)
