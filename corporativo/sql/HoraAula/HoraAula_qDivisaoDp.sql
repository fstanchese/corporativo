select  
  DivTurma.Id as Id,
  DivTurma.Nome as Recognize
from
  divturma,
  horaaula,
  horario,
  semana
where
  HoraAula.DivTurma_Id = DivTurma.Id 
and
  horario.semana_id = semana.id
and
  horaaula.horario_id = horario.id
and
  horaaula.aulati_id = nvl ( p_AulaTi_Id , 0 )
and
  (
    p_O_Data between horaaula.dtinicio and horaaula.dttermino
    or
    p_O_Data < horaaula.dtinicio
  )
and
  horaaula.toxcd_id = nvl( p_TOXCD_Id ,0)
group by DivTurma.Id,DivTurma.Nome
order by 2
