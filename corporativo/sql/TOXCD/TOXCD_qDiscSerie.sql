select
  TOXCD.*,
  TOXCD_gsRecognize(TOXCD.Id)                                         as TOXCD_Recognize,
  Disc.Codigo                                                         as Disc,
  Disc.Nome                                                           as NomeDisc,
  Disc.Nome                                                           as Recognize,
  nvl(WPessoa_gsRecognize(TOXCD.WPessoa_ProfResp_Id),'Sem Professor') as ProfResp
from
  TOXCD,
  CurrXDisc,
  CurrOfe,
  Disc,
  TurmaOfe
where
  Disc.Id = CurrXDisc.Disc_Id
and
  CurrXDisc.Id = TOXCD.CurrXDisc_Id
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0)
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
(
  p_TurmaOfe_Id is null
or
  TOXCD.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0)
)