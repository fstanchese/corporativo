select
  TurmaOfe_gnRetPLetivo(GradAlu.TurmaOfe_Id) as PLetivo_Id
from
  GradAlu
where
  GradAlu.Id = nvl( p_GradAlu_Id ,0)
