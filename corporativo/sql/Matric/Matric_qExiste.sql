select
  Matric.*
from
  Matric
where
  Matric.WPessoa_Id = nvl ( p_WPessoa_Id , 0 )
and
  Matric.TurmaOfe_Id = nvl ( p_TurmaOfe_Id , 0 )