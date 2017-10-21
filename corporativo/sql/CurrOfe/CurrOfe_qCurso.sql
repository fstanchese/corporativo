select
  Distinct(Curso.Id) as Curso_Id
from
  curso,
  curr,
  currofe
where
  Curso.Id = Curr.Curso_Id
and
  Curr.Id = CurrOfe.Curr_Id
and
  (
    p_Campus_Id is null
    or
    CurrOfe.Campus_Id = nvl( p_Campus_Id ,0)
  ) 
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0)
order by Curso_Id