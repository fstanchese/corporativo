select 
  horario.id,
  horario.semana_id,
  horario.periodo_id,
  horario.horarioti_id,
  horario.pletivo_id
from
  horario,
  horaaula
where
  horario.id = horaaula.horario_id
and
  horaaula.id = nvl( p_HoraAula_Id ,0)

