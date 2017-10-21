(
SELECT
	Disc.Id,
	Disc.Codigo AS CodigoDisc,
	Disc.Nome AS NomeDisc 
FROM 
	Disc  
WHERE
	translate(upper(nome),'ацимстзг','AAEIOOUC') LIKE '%'||replace(upper( p_Disc_Nome ),' ','%')||'%'
AND
	p_Disc_Nome IS NOT NULL
UNION
SELECT
	Disc.Id,
	Disc.Codigo AS CodigoDisc,
	Disc.Nome AS NomeDisc 
FROM 
	Disc  
WHERE
	Upper(Codigo) LIKE '%'||replace(upper( p_Disc_Codigo ),' ','%')||'%'
AND
	p_Disc_Codigo IS NOT NULL
)	
ORDER BY NomeDisc