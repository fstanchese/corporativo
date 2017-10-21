select
  trunc(GradAluHi.dt) || ' - ' || GradAluHi.us || ' - ' || GradAluHi.old || ' -> ' || DivTurma_gsRecognize(GradAluHi.new) as Recognize,
  GradAluHi.dt  as Data,
  GradAluHi.us  as Usuario,
  GradAluHi.old as Anterior,
  GradAluHi.new as Atual
from
  GradAluHi
where
  Upper(GradAluHi.col) = 'DIVTURMA_PRATICA_ID'
and
  GradAluHi.Old is not null
and
  GradAluHi.GradAlu_Id = nvl( p_GradAlu_Id ,0)
order by GradAluHi.dt