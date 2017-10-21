select 
  TurmaOfe_gsRetCodTurma(GradAlu.TurmaOfe_Id) as Turma,
  Disc.Codigo                                 as CodDisc,
  CurrXDisc_gnCHTotal(CurrXDisc.Id, p_PLetivo_Id , p_GradAlu_Id ) as CHAnual,
  State_gsRecognize(GradAlu.State_Id)         as Situacao,
  TurmaOfe_gsRetPLetivo(GradAlu.TurmaOfe_Id)  as PLetivo,
  GradAlu.State_Id                            as State_Id,
  GradAlu.GradAluTi_Id                        as GradAluTi_Id
from
  GradAlu,
  CurrXDisc,
  Disc,
  TurmaOfe,
  DiscEsp
where
  GradAlu.TurmaOfe_Id = TurmaOfe.Id
and
  TurmaOfe.DiscEsp_Id = DiscEsp.Id
and
  CurrXDisc.Disc_Id = Disc.Id
and
  GradAlu.CurrXDisc_Id = CurrXDisc.Id
and
  GradAlu.State_Id in ( 3000000003004 )
and
  DiscEsp.DiscEspTi_Id = 17800000000003
and
  GradAlu.WPessoa_Id = nvl( p_WPessoa_Id ,0)
Order by PLetivo
