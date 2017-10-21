select
  TurmaOfe.Id
from
  TurmaOfe,
  CurrOfe
where
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  TurmaOfe.Turma_Id = nvl ( p_Turma_Id , 0 )
and
  CurrOfe.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )

