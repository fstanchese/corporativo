SELECT
  Titulo.*,
  Upper(Titulo.Nome) as TituloUpper,
  ShortName(Titulo.Nome,50) NomeReduz
FROM
  Titulo
WHERE
  Titulo.Id = nvl( p_Titulo_Id ,0)
