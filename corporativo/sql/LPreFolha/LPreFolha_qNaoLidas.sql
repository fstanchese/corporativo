select
  LPreFolha.Id                                              as Codigo,
  TOXCD_gsRetCodDisc(HoraAula.TOXCD_Id)                     as CodDisc,
  shortName(TOXCD_gsRetDisciplina(HoraAula.TOXCD_Id),50)    as Disciplina,
  TOXCD_gsRetTurma(HoraAula.TOXCD_Id)                       as Turma,
  shortName(WPessoa_gsRecognize(LPre.WPessoa_Prof1_Id),30)  as Professor
from
  LPreFolha,
  LPre,
  HoraAula
where
  LPre.HoraAula_Id = HoraAula.Id
and
  LPre.PLetivoP_Id = nvl( p_PLetivoP_Id ,0)
and
  LPre.Id = LPreFolha.LPre_Id
and
  LPreFolha.State_Id = 3000000009002
order by
  Professor, Turma, Disciplina, Codigo

