select
  CurrOfe.Pletivo_Id as Id,
  PLetivo_gsRecognize(CurrOfe.PLetivo_Id) as Recognize
from   
  CurrOfe,
  Curr,   
  Curso,
  PLetivo 
where
  (
    p_Ciclo_Id is null 
      or
    PLetivo.Ciclo_Id = nvl( p_Ciclo_Id ,0 )
  )
and
  CurrOfe.PLetivo_Id = PLetivo.Id   
and
  Curr.Id = CurrOfe.Curr_Id
and
  Curso.Id = Curr.Curso_Id
and
  (
    p_CursoNivel_Id is null 
      or
    curso.cursonivel_id = nvl( p_CursoNivel_Id ,0 )
  )
group by CurrOfe.PLetivo_Id
order by
  2 Desc
