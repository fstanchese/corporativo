
select
  horario.*,
  periodo_gsrecognize(horario.periodo_id) as periodo,
  horario_gsrecognize(horario.id)         as recognize 
from
  semana,
  horario
where
  semana.id = horario.semana_id
and
  horario.periodo_id = nvl( p_Periodo_Id ,0)
order by
  recognize,semana.numero