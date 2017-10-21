select
  GradAlu.Id as GradAlu_Id
from
  GradAlu
where
  GradAlu.State_Id = 3000000003001
and
  GradAlu.WPessoa_Id = nvl( p_WPessoa_Id ,0)
