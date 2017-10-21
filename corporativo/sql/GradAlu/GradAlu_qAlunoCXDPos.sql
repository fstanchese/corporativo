select
  GradAlu.*
from
  GradAlu
where
  GradAlu.TurmaOfe_Id = nvl ( p_TurmaOfe_Id , 0)
and
  GradAlu.CurrXDisc_Id = nvl( p_CurrXDisc_Id , 0)
and
  GradAlu.WPessoa_Id = nvl( p_WPessoa_Id , 0)
