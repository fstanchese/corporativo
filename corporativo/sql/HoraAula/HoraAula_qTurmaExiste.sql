select
  Count(HoraAula.Id) as Total
from
  TOXCD,
  HoraAula,
  TurmaOfe
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  TurmaOfe.Id = TOXCD.TurmaOfe_Id
and
  TurmaOfe.Id = nvl( p_TurmaOfe_Id ,0)
