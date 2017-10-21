select
   count(*),
   Matric.WPessoa_Id
from
  Matric
where
  Matric.TurmaOfe_Id = nvl ( p_TurmaOfe_Id ,0 )
order by
