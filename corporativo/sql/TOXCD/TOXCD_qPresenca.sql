(
select
  TOXCD.Id,
  TOXCD_gsRetTurma(TOXCD.Id)                   as Turma,
  TOXCD_gsRetCodDisc(TOXCD.Id)                 as CodDisc,
  TOXCD_gsRetDisciplina(TOXCD.Id)              as NomeDisc,
  TOXCD_gsRetCurso(TOXCD.ID)                   as Curso,
  TOXCD.TurmaOfe_Id                            as TurmaOfe_Id,
  TurmaOfe_gnRetCursoNivel(TOXCD.TurmaOfe_Id)  as CursoNivel_Id 
from
  Turma,
  TOXCD,
  TurmaOfe,
  CurrOfe
where
  TurmaOfe.Turma_Id = Turma.Id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  (
    p_Campus_Id is null
     or
    Turma.Campus_Id = nvl ( p_Campus_Id ,0)
  )
and
  (
    p_TurmaOfe_Id is null
     or
    TOXCD.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0)
  )
and
  (
    p_TOXCD_Id is null
     or
    TOXCD.Id = nvl( p_TOXCD_Id ,0)
  )
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0) 
)
union
(
select
  TOXCD.Id,
  TOXCD_gsRetTurma(TOXCD.Id)                   as Turma,
  TOXCD_gsRetCodDisc(TOXCD.Id)                 as CodDisc,
  TOXCD_gsRetDisciplina(TOXCD.Id)              as NomeDisc,
  TOXCD_gsRetCurso(TOXCD.ID)                   as Curso,
  TOXCD.TurmaOfe_Id                            as TurmaOfe_Id,
  TurmaOfe_gnRetCursoNivel(TOXCD.TurmaOfe_Id)  as CursoNivel_Id 
from
  TOXCD,
  Turma,
  TurmaOfe,
  DiscEsp  
where
  TurmaOfe.Turma_Id = Turma.Id
and
  DiscEsp.Id = TurmaOfe.DiscEsp_Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  (
    p_TurmaOfe_Id is null
     or
    TOXCD.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0)
  )
and
  (
    p_Campus_Id is null
     or
    Turma.Campus_Id = nvl ( p_Campus_Id ,0)
  )
and
  (
    p_TOXCD_Id is null
     or
    TOXCD.Id = nvl( p_TOXCD_Id ,0)
  )
and
  DiscEsp.PLetivo_Id = nvl( p_PLetivo_Id ,0)
)
order by 2,3  