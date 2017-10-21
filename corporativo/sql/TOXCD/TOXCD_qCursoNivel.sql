(
  select
    Curso.CursoNivel_Id,
    Curso.Id as Curso_Id
  from
    Curso,
    Curr,
    Currofe,
    TurmaOfe,
    TOXCD
  where
    Curr.Curso_Id = Curso.Id
  and
    CurrOfe.Curr_Id = Curr.Id
  and
    TurmaOfe.Currofe_Id = CurrOfe.Id
  and
    TOXCD.TurmaOfe_Id = TurmaOfe.Id
  and
    TOXCD.Id = nvl( p_TOXCD_Id ,0)
)
union
(
  select
    Curso.CursoNivel_Id,
    Curso.Id as Curso_Id
  from
    Curso,
    Turma,
    DiscEsp,
    TurmaOfe,
    TOXCD
  where
    Curso.Id = Turma.Curso_Id
  and
    Turma.Id = TurmaOfe.Turma_Id
  and
    DiscEsp.Id = TurmaOfe.DiscEsp_Id
  and
    TurmaOfe.Id = TOXCD.TurmaOfe_Id
  and
    TOXCD.Id = nvl( p_TOXCD_Id ,0)
)