SELECT  
	CurrNivel.Id, 
	CurrNivel.Nome, 
	CurrNivel_gsRecognize(CurrNivel.Id) as Recognize 
FROM  
	CurrNivel
WHERE  
	CurrNivel.Id = nvl( p_CurrNivel_Id ,0)