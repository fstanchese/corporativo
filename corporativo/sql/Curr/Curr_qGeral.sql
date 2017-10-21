SELECT 
	Curr.*,
	Curr_gsRecognize(Curr_Pai_Id) as PaiRecognize,
	Curr_gsRecognize(Id)          as Recognize
FROM 
	Curr 
ORDER BY
	Recognize