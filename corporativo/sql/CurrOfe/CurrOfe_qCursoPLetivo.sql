select
  Distinct CurrOfe.Id
from
  curr,
  currofe
where
  Curr.Curso_Id = nvl( p_Curso_Id ,0)
and
  Curr.Id = CurrOfe.Curr_Id
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0)
order by Curso_Id