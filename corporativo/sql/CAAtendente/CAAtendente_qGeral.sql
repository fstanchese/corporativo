SELECT 
	WPessoa_gsRecognize(WPessoa_Id) as PESSOA,
	CAMesa_gsRecognize(CAMesa_Id) AS MESA,
	CAAtendente.*
FROM
	CAAtendente
	
ORDER BY mesa, pessoa
