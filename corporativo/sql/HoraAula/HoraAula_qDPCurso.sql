select
  count(dexcd.id) as QTDE
from
  TurmaOfe,
  TOXCD,
  DEXCD,
  CurrXDisc,
  Curr
where
  Curr.Curso_Id =  nvl( p_Curso_Id ,0)
and
  CurrXDisc.Curr_Id = Curr.Id
and
  CurrXDisc.Id = DEXCD.CurrXDisc_Id
and
  DEXCD.DiscEsp_Id = TurmaOfe.DiscEsp_Id
and
  TurmaOfe.Id = TOXCD.TurmaOfe_Id
and
  TOXCD.Id = nvl( p_TOXCD_Id ,0)
 