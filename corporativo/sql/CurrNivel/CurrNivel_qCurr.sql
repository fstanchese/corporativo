SELECT  
	CurrNivel.Id, 
	CurrNivel.Nome, 
	CurrNivel_gsRecognize(CurrNivel.id) as Recognize 
FROM
	CurrNivel  
WHERE
	CurrNivel.Id in (7400000000001,7400000000003)
ORDER BY CurrNivel.Nome