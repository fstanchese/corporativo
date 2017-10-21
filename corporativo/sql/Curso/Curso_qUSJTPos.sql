select 
  distinct(curso.id),
  curso.*,
  curso_gsrecognize(curso.id) as recognize
from 
  CurrOfe,
  Curr,
  Curso
where
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0) 
and
  CurrOfe.Campus_Id = nvl( p_Campus_Id ,0)
and
  CurrOfe.Curr_Id = Curr.Id
and
  Curr.Curso_Id = Curso.Id
and 
  Curso.InstEns_Id = 8900000000001
and
  Curso.CursoNivel_Id in ( 6200000000002 , 6200000000008 )
order by
  Curso.CursoNivel_Id desc , Curso.Nome
