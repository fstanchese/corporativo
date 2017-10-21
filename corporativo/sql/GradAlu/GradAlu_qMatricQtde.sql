select
  Count(*) as Total
from
  GradAlu
where
  GradAlu.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0 )
and
  GradAlu.Matric_Id = nvl( p_Matric_Id ,0 )
