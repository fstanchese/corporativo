select
  TurmaOfe.Sala_Id as Id,
  Sala_gsRecognize(Sala_Id) as Recognize 
from
  CurrOfe,
  TurmaOfe
where
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  CurrOfe.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
and
  TurmaOfe.Turma_Id = nvl ( p_Turma_Id , 0 )
union
select
  TurmaOfe.Sala_Id as Id,
  Sala_gsRecognize(Sala_Id) as Recognize 
from
  DiscEsp,
  TurmaOfe
where
  TurmaOfe.DiscEsp_Id = DiscEsp.Id
and
  DiscEsp.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
and
  TurmaOfe.Turma_Id = nvl ( p_Turma_Id , 0 )
