SELECT  
  Id                         AS ID,
  Codigo                     AS NOME,
  NomeCompleto               AS NOMECOMPLETO,
  CursoNivel_gsRecognize(Id) AS recognize
FROM  
  CursoNivel  
ORDER BY 
  Nome
  