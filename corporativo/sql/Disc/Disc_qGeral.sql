SELECT
	Disc.Id,
	Disc.Codigo AS CodigoDisc,
	Disc.Nome   AS NomeDisc,
	Disc_gsRecognize(Disc.Id) as Recognize
FROM
	Disc
ORDER BY 
	Disc.Nome