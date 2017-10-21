select 
  Id,
  Codigo,
  Nome,
  curso_gsRecognize(id) as Recognize
from 
  Curso
where 
 (
   Facul_Id = nvl( p_Facul_Id ,0)
     or
   p_Facul_Id is null
  )
and
 (
   CursoNivel_Id = nvl( p_CursoNivel_Id ,0)
     or
   p_CursoNivel_Id is null
  )
and
  InstEns_Id = 8900000000001
order by
 4