select
  WPessoa_gsRecognize(GradAlu.WPessoa_Id)         as Aluno,
  WPessoa.Codigo                                  as RA,
  CurrXDisc.DiscCat_Id                            as DiscCat_Id,
  GradAluTi_gsRecognize(GradAlu.GradAluTi_Id)     as GradAluTi,
  CurrXDisc_gsRetCodDisc(GradAlu.CurrXDisc_Id)    as CodDisc,
  CurrXDisc_gsRetDisc(GradAlu.CurrXDisc_Id)       as NomeDisc,
  TurmaOfe_gsRetCodTurma(GradAlu.TurmaOfe_Id)     as Turma,
  CurrXDisc_gnRetIdCurr(GradAlu.CurrXDisc_Id)     as Curr_Id,
  CurrXDisc_gsRetSerie(CurrXDisc_Id)              as Serie,
  GradAlu.*
from
  WPessoa,
  CurrXDisc,
  GradAlu
where
  GradAlu.State_Id not in ( 3000000003002,3000000003009,3000000003003,3000000003010 )
and
  WPessoa.Id = GradAlu.WPessoa_Id
and
  CurrXDisc.Id = GradAlu.CurrXDisc_Id
and
  GradAlu.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0 )
order by NomeDisc,Aluno