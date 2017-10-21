select 
  to_char(horainicio,'hh24:mi') as hora,
  semana_id,
  duracao 
from 
  horario
where 
  horarioti_id = nvl( p_HorarioTi_Id ,0)
and
  periodo_id = nvl( p_Periodo_Id ,0) 
group by semana_id,to_char(horainicio,'hh24:mi'),duracao
order by 1,2
