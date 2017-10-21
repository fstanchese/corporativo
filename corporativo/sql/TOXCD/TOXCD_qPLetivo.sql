select
  TOXCD_gsRetTurma(TOXCD.Id)                         as Turma,
  TOXCD_gsRetCodDisc(TOXCD.Id)                       as CodDisc,
  TOXCD_gsRetDisciplina(TOXCD.Id)                    as NomeDisc,
  CriDivTur_gsRecognize(TOXCD.CriDivTur_Teoria_Id)   as DivTeoria,
  CriDivTur_gsRecognize(TOXCD.CriDivTur_Pratica_Id)  as DivPratica,
  CriDivTur_gsRecognize(TOXCD.CriDivTur_Lab_Id)      as DivLab,
  DivTeoria                                          as QtdeDivTeoria,
  DivPratica                                         as QtdeDivPratica,
  DivLab                                             as QtdeDivLab,
  CHSemanalTeoria                                    as CHTeoria,
  CHSemanalPratica                                   as CHPratica,
  CHSemanalLab                                       as CHLab,
  CHSemanalExerc                                     as CHExercicio,
  Curso.Id                                           as Curso_Id,
  TOXCD.Id                                           as TOXCD_Id,
  Curso.Nome                                         as CursoNome                                  
from
  TOXCD,
  TurmaOfe,
  CurrOfe,
  CurrXDisc,
  Curr,
  Curso
where
  (
    p_Periodo_Id is null
    or
    CurrOfe.Periodo_Id = nvl ( p_Periodo_Id , 0 )
  )
and
  (
    p_Campus_Id is null
    or
    CurrOfe.Campus_Id = nvl ( p_Campus_Id , 0 )
  )
and
  (
    p_Curso_Id is null
    or
    Curso.Id = nvl( p_Curso_Id ,0)
  )
and
  TOXCD.CurrXDisc_Id = CurrXDisc.Id
and
  Curr.Curso_Id = Curso.Id
and
  CurrOfe.Curr_Id = Curr.Id
and
  TurmaOfe.Id = TOXCD.TurmaOfe_Id
and
  CurrOfe.Id = TurmaOfe.CurrOfe_Id
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0) 
order by Curso.Nome, Turma, CodDisc