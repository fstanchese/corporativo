SELECT  
	CurrNivel.Id, 
	CurrNivel.Nome, 
	CurrNivel_gsRecognize(CurrNivel.id) as Recognize 
FROM
	CurrNivel  
ORDER BY
	CurrNivel.Id