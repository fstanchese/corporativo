select
  Matric.TurmaOfe_Id as TurmaOfe_Id
from
  GradAlu,
  Matric
where
  GradAlu.GradAluTi_Id = 8500000000004
and
  GradAlu.Matric_Id = Matric.Id
and
  (
    p_State_Id is null
  or
    Matric.State_Id = nvl( p_State_Id ,0)
  )
and
  Matric.WPessoa_Id = nvl( p_WPessoa_Id ,0)