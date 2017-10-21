select 
  CurrOfe.Id                      as Id,
  CurrOfe_gsRecognize(CurrOfe.Id) as Recognize
from
  CursoNivel,
  Curso, 
  CurrOfe,
  Curr
where
  Curso.CursoNivel_Id = CursoNivel.Id
and
  (
    p_CursoNivel_Id is null
    or
    CursoNivel.Id = nvl( p_CursoNivel_Id ,0)
  )
and
  Curr.Curso_Id = Curso.Id
and
  CurrOfe.Curr_Id = Curr.Id
and
  (
    p_Periodo_Id is null
    or
    CurrOfe.Periodo_Id = nvl( p_Periodo_Id ,0)
  ) 
and
  (
    p_Campus_Id is null
    or
    CurrOfe.Campus_Id = nvl( p_Campus_Id ,0)
  )
and
  PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
order by 2