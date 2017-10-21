SELECT 
  Id,
  Codigo,
  Nome,
  InstEns_Id,
  Nome as Recognize,
  Facul_Id
FROM 
  Curso
WHERE 
  (
    translate(upper(Curso.Nome),'ацимстзгй','AAEIOOUCE') like '%'||replace( trim( translate(upper( p_Curso_Nome ),'ацимстзгй','AAEIOOUCE') ),' ','%')||'%'
  or 
    p_Curso_Nome is null
  )
and
  CursoNivel_Id = nvl ( p_CursoNivel_Id , 0 )
AND
  InstEns_Id = 8900000000001
ORDER BY
  Nome