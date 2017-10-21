select
  WPessoa_gsRecognize(HoraProva.WPessoa_Id)                 as Professor,
  HoraProva.WPessoa_Id                                      as ProfessorId,
  TOXCD_gsRetTurma(HoraProva.TOXCD_Id)                      as Turma,
  SubStr(TOXCD_gsRetDisciplina(HoraProva.TOXCD_Id),1,50)    as Disciplina,
  shortname(WPessoa_gsRecognize(HoraProva.WPessoa_Id),30)   as NomeProf,
  shortname(TOXCD_gsRetDisciplina(TOXCD_Id),30)             as NomeDisc,
  DivTurma_gsRecognize(HoraProva.DivTurma_Id)               as DivTurma,
  to_char(HoraProva.data,'dd/mm/yyyy')                      as Dia,
  to_char(HoraProva.data,'HH24:mi')                         as Hora,
  Sala_gsRecognize(HoraProva.Sala_Id)                       as Sala,
  Curso.Nome                                                as Curso,
  CriAvalPDt_gsRecognize(HoraProva.CriAvalPDt_Id)           as CriAvalPDt,
  Campus_gsRecognize(Turma.Campus_Id)                       as Campus
from
  HoraProva,
  Curso,
  TOXCD,
  TurmaOfe,
  Turma
where
  (
    p_Campus_Id is null
      or
    Turma.Campus_Id  = nvl(  p_Campus_Id ,0)
  )
and
  TurmaOfe.Turma_Id = Turma.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  HoraProva.TOXCD_Id = TOXCD.Id
and
  TOXCD_gnRetCurso(HoraProva.TOXCD_Id) = Curso.Id    
and
  (
    p_Facul_Id is null
      or
    Curso.Facul_Id  = nvl( p_Facul_Id ,0)
  )
and
  (
    p_Curso_Id is null
      or
    Curso.Id  = nvl( p_Curso_Id ,0)
  )
and
  (
    p_WPessoa_Id is null
     or
    HoraProva.WPessoa_Id  = nvl( p_WPessoa_Id ,0)
  ) 
and
  HoraProva.CriAvalPDt_Id = nvl( p_CriAvalPDt_Id ,0)
order by
  $v_OrderBy