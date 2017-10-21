select
  Horario.*,
  to_char(horario.horainicio,'HH24:MI') as hora_inicio
from
  Horario
where
HorarioTi_Id = 12800000000001 
order by horainicio,semana_id
