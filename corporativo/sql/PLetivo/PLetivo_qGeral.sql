SELECT
	id, nome as Recognize
FROM 
	pletivo
	
WHERE 
	( ano_id = p_Ano_Id or p_Ano_Id is null )

order by Ciclo_Id,Nome desc