SELECT 
  curso.id,
  instens_id,
  curso_gsrecognize(curso.id) as recognize,
  curso_gncoordenador( curso.id ) as profid,
  WPessoa_gsRecognize(curso_gncoordenador( curso.id )) as profnome
FROM 
  curso
WHERE
  (
    p_CursoNivel_Id is null 
    or 
    CursoNivel_Id = nvl( p_CursoNivel_Id ,0 )
  )
AND
  (
    Curso.Facul_Id = nvl( p_Facul_Id , 0)
    or
    p_Facul_Id is null
  )
AND
  Curso.InstEns_Id = 8900000000001
ORDER BY
  Recognize