select
  CurrXDisc.DiscCat_Id                            as DiscCat_Id,
  GradAluTi_gsRecognize(GradAlu.GradAluTi_Id)     as GradAluTi,
  CurrXDisc_gsRetCodDisc(GradAlu.CurrXDisc_Id)    as Disc,
  TurmaOfe_gsRetCodTurma(GradAlu.TurmaOfe_Id)     as Turma,
  CurrXDisc_gnRetIdCurr(GradAlu.CurrXDisc_Id)     as Curr_Id,
  CurrXDisc_gsRetSerie(CurrXDisc_Id)              as Serie,
  GradAlu.*
from
  CurrXDisc,
  GradAlu
where
  CurrXDisc.Id = GradAlu.CurrXDisc_Id
and
  GradAlu.Matric_Id = nvl( p_Matric_Id ,0)
