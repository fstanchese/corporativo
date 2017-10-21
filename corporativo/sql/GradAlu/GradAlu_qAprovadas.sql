oDoc ( Apesar do nome coloquei tb as disciplinas reprovadas,trancadas e que o aluno cursou. Fábio. )


select
  GradAlu.Id                                     as GradAlu_Id,
  CurrXDisc_gsRetCodDisc(CurrXDisc_Id)           as CodDisciplina,
  CurrXDisc_gsRetDisc(CurrXDisc_Id)              as Disciplina,
  CurrXDisc_gsRetCodCurr(CurrXDisc_Id)           as CodCurriculo,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)    as DuracXCi_Recognize,
  CurrXDisc.DuracXCi_Id                          as DuracXCi_Id,
  upper(substr(state_gsRecognize(state_id),1,3)) as State_Abreviado
from
  GradAlu,
  CurrXDisc,
  Curr,
  Curso
where
  (
    Curso.CursoNivel_Id = p_CursoNivel_Id
  or
    p_CursoNivel_Id is null
  )
and
  Curr.Curso_Id = Curso.Id
and
  (
    CurrXDisc.DiscCat_Id in (5900000000001,5900000000002,5900000000014)
  or
    CurrXDisc. DiscCat_Id is null
  )
and
  (
    GradAlu.GradAluTi_Id = p_GradAluTi_Id
  or
    p_GradAluTi_Id is null
  )
and
  (
    GradAlu_gnRetPLetivo(GradAlu.Id) = p_PLetivo_Id
  or
    p_PLetivo_Id is null
  )
and
  CurrXDisc.Curr_Id = Curr.Id
and
  GradAlu.CurrXDisc_Id = CurrXDisc.Id
and
  GradAlu.State_Id in ( 3000000003001, 3000000003004, 3000000003006, 3000000003007, 3000000003008, 3000000003009 , 3000000003003 ) 
and
  GradAlu.WPessoa_Id = p_WPessoa_Id 
order by
  Curr.Curso_Id, CurrXDisc.DuracXCi_Id, CodDisciplina