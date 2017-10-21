select
  GradAluHi.Us                                   as Usuario_Hi,
  to_char(GradAluHi.Dt,'dd/mm/yyyy hh24:mi')     as Data_Hi,
  TurmaOfe_gsRetCodTurma(TurmaOfe_Id)            as Turma,
  CurrXDisc_gsRetCodDisc(CurrXDisc_Id)           as Disc,
  CurrXDisc_gsRetDisc(CurrXDisc_Id)              as Disciplina,
  GradAlu.HoraProva_Esp_Id                       as HoraProva_Esp_Id,
  WPessoa_gsRecognize(GradAlu.WPessoa_Id)        as Aluno_Recognize,
  GradAlu.Id                                     as GradAlu_Id 
from
  GradAlu,
  GradAluHi
where
  GradAlu.Id = GradAluHi.GradAlu_Id
and
  (
    GradAluHi.GradAlu_Id = p_GradAluHi_GradAlu_Id
  or
    p_GradAluHi_GradAlu_Id is null
  )
and
  (
    upper(GradAluHi.Col) = p_GradAluHi_Col
  or
    p_GradAluHi_Col is null
  )
and
  ( 
    GradAluHi.Dt > sysdate - 7
  or
    p_VerificaData is null
  )
order by
  Aluno_Recognize 