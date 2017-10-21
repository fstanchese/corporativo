select
  GradAlu.Id                                   as GradAlu_Id,
  GradAlu.WPessoa_Id                           as WPessoa_Id,
  TurmaOfe_gsRetCodTurma(GradAlu.TurmaOfe_Id)  as TurmaGrad,
  CurrXDisc_gsRetCodDisc(GradAlu.CurrXDisc_Id) as DiscGrad,
  TurmaOfe.DiscEsp_Id                          as DiscEsp,
  CurrXDisc_gnChTotal(GradAlu.CurrXDisc_Id, p_PLetivo_Id )  as chanual
from
  GradAlu,
  TOXCD,
  TurmaOfe
where
  TurmaOfe_gnRetPLetivo(GradAlu.TurmaOfe_Id) = nvl( p_PLetivo_Id ,0)
and
  TurmaOfe.CurrOfe_Id is null
and
  TurmaOfe.Id = TOXCD.TurmaOfe_Id
and
  GradAlu.TurmaOfe_Id = TOXCD.TurmaOfe_Id
and
  Gradalu.GradAluTi_Id = 8500000000003
and
  GradAlu.State_Id = 3000000003001
and
  GradAlu.WPessoa_Id = nvl( p_WPessoa_Id ,0)