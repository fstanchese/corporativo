select
  Sala.Codigo       as Sala,
  Turma.Codigo      as Turma,
  Sala.Metragem     as Metragem,
  Sala.QtdCarteiras as Carteiras_Sala,
  Sala.QtdAtualCart as Carteiras,
  TurmaOfe.Id       as TurmaOfe_Id
from
  CurrOfe,
  Turma, 
  TurmaOfe,
  Sala
where
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0) 
and
  CurrOfe.Id = TurmaOfe.CurrOfe_Id
and
  Turma.Id = TurmaOfe.Turma_Id
and
  TurmaOfe.Sala_Id = Sala.Id
and
  Sala.Campus_Id = nvl( p_Campus_Id ,0)
order by
  Sala.Andar_Id,Sala.Bloco_Id,Sala.Codigo