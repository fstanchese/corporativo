select
  trunc(MatricHi.dt) || ' - ' || MatricHi.us || ' - ' || State_gsrecognize(to_number(old)) || ' -> ' || State_gsrecognize(to_number(new)) || ' - ' || CurrXDisc_gsRetCodDisc(GradAlu.CurrXDisc_Id) || ' - ' || TurmaOfe_gsRetCodTurma(GradAlu.TurmaOfe_Id) as Recognize,
  MatricHi.dt  as Data,
  MatricHi.us  as Usuario,
  MatricHi.old as Anterior,
  MatricHi.new as Atual
from
  MatricHi,
  Matric,
  Matricti,
  gradalu
where
  matric.id = gradalu.matric_id
and
  Upper(MatricHi.col) = 'STATE_ID'
and
  to_number(MatricHi.new)=3000000002008 
and
  Matric.State_id in ( 3000000002002 )
and
  MatricHi.Matric_Id = Matric.Id
and
  Matric.WPessoa_Id = nvl ( p_WPessoa_Id ,0 )
order by MatricHi.dt