select
  Curso.Id   as Id,
  Curso.Nome as NomeCurso,
  Facul_gsRecognize(Facul_Id) as NomeFacul, 
  Curso_gsRecognize(Curso.Id) as Recognize,
  WPessoa_gsRecognize(Curso.WPessoa_AtivComp_Id) as ProfResp
from
  Curso
where
  (
    p_Facul_Id is null
    or
    Curso.Facul_Id = nvl ( p_Facul_Id , 0 )
  )
and
  (
    p_CursoNivel_Id is null
     or
    Curso.Cursonivel_Id = nvl( p_CursoNivel_Id ,0)
  ) 
and
  (
    p_Curso_Id is null
     or
    Curso.Id = nvl( p_Curso_Id ,0)
  ) 
and
  Curso.InstEns_Id = 8900000000001
order by 2
