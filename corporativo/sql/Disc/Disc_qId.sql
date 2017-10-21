SELECT
	Disc.Id,
	Disc.Codigo,
	Disc.Nome as NomeDisc,
	Disc.Codigo as CodigoDisc,	
	Upper(Disc.Nome) as NomeCaps
FROM
	Disc
WHERE
	Disc.id = nvl( p_Disc_Id ,0)