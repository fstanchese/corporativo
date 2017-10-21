SELECT
	Id, 
	Ano AS Recognize
FROM 
	Ano	
WHERE ( Ano = p_teste or p_teste IS NULL )
ORDER BY 
	Ano