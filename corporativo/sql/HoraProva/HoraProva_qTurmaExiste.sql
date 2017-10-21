select
  Count(HoraProva.Id) as Total
from
  TOXCD,
  HoraProva,
  TurmaOfe
where
  HoraProva.TOXCD_Id = TOXCD.Id
and
  TurmaOfe.Id = TOXCD.TurmaOfe_Id
and
  TurmaOfe.Id = nvl( p_TurmaOfe_Id ,0)
