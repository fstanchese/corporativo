select 
  Curr.Id,
  Curr_gsRetCodCurr(Curr.Id) as Recognize
from
  Curso, 
  CurrOfe, 
  Curr 
where 
  Curso.Id = Curr.Curso_Id
and
  Curr.Id = CurrOfe.Curr_Id
and
  Curso.Id = nvl( p_Curso_Id ,0)
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0)
group by Curr.Id
order by 2

