select
  horario.*,
  periodo_gsrecognize(horario.periodo_id)     as periodo,
  to_char(horario.horainicio,'hh24:mi')||' - '||semana_gsrecognize(semana.id) as recognize,
  horarioti_gsrecognize(horario.horarioti_id) as tipohora,
  to_char(horario.horainicio,'hh24:mi')       as hora,
  semana_gsrecognize(semana.id)               as diasemana,
  semana.numero                               as numero   
from
  semana,
  horario
where
  semana.id = horario.semana_id
and
  ( 
    p_Semana_Id is null 
      or 
    horario.semana_id = nvl( p_Semana_Id ,0)
  )
and
  ( 
    p_Periodo_Id is null 
      or
    horario.periodo_id = nvl( p_Periodo_Id ,0)
  )
and
  ( 
    p_HorarioTi_Id is null
      or 
    horario.horarioti_id = nvl( p_HorarioTi_Id ,0) 
  )
order by
  periodo,semana.numero,horainicio
