select
  TurmaOfe.Id as Id 
from
  TurmaOfe
where
  TurmaOfe.CurrOfe_Id = nvl ( p_CurrOfe_Id , 0 )
and
  TurmaOfe.Turma_Id   = nvl ( p_Turma_Id , 0 )
