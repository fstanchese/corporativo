select 
  to_char(horario.horainicio,'HH24:MI') as hora_inicio
from
  horario
group by horainicio
order by 1
