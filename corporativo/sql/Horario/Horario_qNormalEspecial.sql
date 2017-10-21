select
  *  
from
  Horario
where
(
  HorarioTi_Id = 12800000000001 
  or
  HorarioTi_Id = 12800000000002 
)
order by horainicio,semana_id
