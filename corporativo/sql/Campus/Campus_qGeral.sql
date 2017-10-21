SELECT  
	Campus.Id, 
	Campus.Nome, 
	Campus_gsRecognize(Campus.Id) as Recognize 
FROM  
	Campus  
ORDER BY
	Campus.Nome