select
  semana.numero,
  to_char(horario.horainicio,'hh24:mi') as horainicio,
  semana.nome,
  horario.id as horario_id,
  semana.id as semana_id,
  divturma_gsrecognize(horaaula.divturma_id) as divisao
from
  horaaula,
  horario,
  semana
where
  horario.semana_id = semana.id
and
  horaaula.horario_id = horario.id
and
  (
    p_O_Data between horaaula.dtinicio and horaaula.dttermino
    or
    p_O_Data < horaaula.dtinicio
  )
and
  (
     p_DivTurma_Id is null
     or
     HoraAula.DivTurma_Id = nvl( p_DivTurma_Id , 0 )
     or
     HoraAula.DivTurma_Id is null
  )
and
  horaaula.toxcd_id = nvl( p_TOXCD_Id ,0)
order by 1,2
