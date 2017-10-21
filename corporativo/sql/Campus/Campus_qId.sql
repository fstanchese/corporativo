SELECT  
	Campus.Id, 
	Campus.Nome, 
	Campus_gsRecognize(Campus.Id) as Recognize,
	Campus.IPClasse
FROM
	Campus  
WHERE  
	Campus.Id = nvl( p_Campus_Id ,0 )