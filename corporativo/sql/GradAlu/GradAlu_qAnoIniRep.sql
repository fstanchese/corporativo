select
  Count(*) as Total
from
  GradAlu
where
  GradAlu_gnRetPLetivo(GradAlu.Id) = nvl ( p_PLetivo_Id ,0)
and
  GradAlu.GradAluTi_Id <> 8500000000004
and
  GradAlu.State_Id = 3000000003004 
and
  GradAlu.WPessoa_Id = nvl( p_WPessoa_Id ,0)

