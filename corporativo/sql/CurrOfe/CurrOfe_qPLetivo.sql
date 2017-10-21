select
  Distinct(Curso.Nome) as Curso
from
  curso,
  curr,
  currofe
where
  Curso.CursoNivel_Id = nvl( p_CursoNivel_Id ,0)
and
  Curso.Id = Curr.Curso_Id
and
  Curr.Id = CurrOfe.Curr_Id
and
  CurrOfe.Campus_Id = nvl( p_Campus_Id ,0)
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0)