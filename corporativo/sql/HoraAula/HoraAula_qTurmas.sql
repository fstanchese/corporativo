select 
  Turma.Id as Id,
  Turma.Codigo as Recognize,
  Turma.Periodo_Id as Periodo_Id,
  Curso.Nome as CursoNome,
  Curso.Id   as Curso_Id,
  Curr.Codigo as CurrCodigo,
  Curr.Id   as Curr_Id,
  TurmaOfe.Id as TurmaOfe_Id
from
  CurrOfe,
  TurmaOfe,
  Turma,
  DuracXCi,
  Curso,
  Curr
where
  CurrOfe.Curr_Id = Curr.Id
and
  Turma.DuracXCi_Id = DuracXCi.Id
and
  Turma.Curso_Id = Curso.Id
and
  TurmaOfe.Turma_Id = Turma.Id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  (
    p_Campus_Id is null
    or
    Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
  )
and
  (
    p_Periodo_Id is null
    or
    Turma.Periodo_Id = nvl ( p_Periodo_Id , 0 )
  )
and
  (
    p_DuracXCi_Sequencia is null
    or
    DuracXCi.Sequencia = nvl ( p_DuracXCi_Sequencia , 0 )
  )
and
  (
    p_Curso_Id is null
    or
    Turma.Curso_Id = nvl ( p_Curso_Id , 0) 
  )
and
  CurrOfe.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
order by 4,3,2