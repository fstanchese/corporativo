select
  trunc(MatricHi.dt) || ' - ' || MatricHi.us || ' - ' || TurmaOfe_gsRetCodTurma(MatricHi.old) || ' -> ' || TurmaOfe_gsRetCodTurma(MatricHi.new) as Recognize,
  MatricHi.dt  as Data,
  MatricHi.us  as Usuario,
  MatricHi.old as Anterior,
  MatricHi.new as Atual,
  TurmaOfe_gsRetCodTurma(MatricHi.old) as TurmaOld,
  TurmaOfe_gsRetCodTurma(MatricHi.new) as TurmaNew,
  to_number(MatricHi.new) as newTurmaOfe_Id
from
  MatricHi
where
  Upper(MatricHi.col) = 'TURMAOFE_ID'
and
  MatricHi.Old is not null
and
  MatricHi.Matric_Id = nvl( p_Matric_Id ,0)
order by MatricHi.dt