select   
  Curso.Id   as id,
  Curso_gsRecognize(Curso.Id) as Recognize
from 
  Curso,
  CurrOfe,
  Curr
where
  Curso.CursoNivel_Id in (6200000000001,6200000000003,6200000000010,6200000000012)
and
  Curr.Curso_Id = Curso.Id
and
  CurrOfe.Curr_Id = Curr.Id
and
  (
    p_Campus_Id is null
      or
    CurrOfe.Campus_Id = nvl ( p_Campus_Id ,0)
  )
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0)
and
  InstEns_Id = 8900000000001
group by Curso.Id
union
select   
  Curso.Id   as id,
  Curso_gsRecognize(Curso.Id) as Recognize
from
  curso
where  
  Curso.Id = 5700000000069 
order by Recognize