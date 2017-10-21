select 
  Turmaofe.Id,
  TurmaOfe.Currofe_Id,
  TurmaOfe.Turma_Id,
  Turma_gsrecognize(TurmaOfe.Turma_Id) as recognize
from
  TurmaOfe,
  CurrOfe
where
  ( 
    TurmaOfe.Turma_Id = nvl ( p_Turma_Id , 0 )
  or
    p_Turma_Id is null
  )
and 
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0) 
order by
  TurmaOfe.Turma_Id
