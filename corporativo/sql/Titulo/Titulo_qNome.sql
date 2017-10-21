SELECT
	Titulo.Id as Id
FROM
	Titulo
WHERE
	Upper(Titulo.Nome) = p_Titulo_Nome