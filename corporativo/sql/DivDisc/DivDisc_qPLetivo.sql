select
  DivDisc.*,
  TOXCD_gsRetTurma(TOXCD.Id) || ' - ' || TOXCD_gsRetCodDisc(TOXCD.Id) || ' - ' || DivDisc_gsRecognize(DivDisc.Id) as Recognize
from
  DivDisc,
  TOXCD,
  CurrOfe,
  TurmaOfe
where
  TOXCD.Id = DivDisc.TOXCD_Id
and
  TurmaOfe.Id = TOXCD.TurmaOfe_Id
and
  CurrOfe.Id = TurmaOfe.CurrOfe_Id
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0)
order by Recognize