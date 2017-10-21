SELECT
  RecCurso.*,
  Curso.Nome as NomeCurso   
FROM
  Curso,
  RecCurso
WHERE
  Curso.Id = RecCurso.Curso_Id
AND
  RecCurso.Id = nvl ( p_RecCurso_Id , 0 )
