select
  to_char(min(horaaula.dtinicio),'dd-mm-yyyy') as DtInicio
from
  HoraAula,
  TurmaOfe,
  TOXCD
where
  HoraAula.TOXCD_Id = TOXCD.Id
and
  Turmaofe.Id = TOXCD.TurmaOfe_Id
and
  TurmaOfe.Id = nvl( p_TurmaOfe_Id ,0 )