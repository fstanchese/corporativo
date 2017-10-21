select 
  to_char(avg( nvl(pontos,0)),'999G990D99')  as MEDIA
from 
  BolsaSol
where
  state_id != 3000000012001
  and
  state_id != 3000000012003
  and
  pletivo_id = nvl( p_PLetivo_Id ,0)
