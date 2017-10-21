
select 
  horario.*
from 
  horario
where 
  horario.id = nvl( p_Horario_Id ,0)
