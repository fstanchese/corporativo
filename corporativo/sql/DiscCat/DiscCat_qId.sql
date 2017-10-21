SELECT 
	Id,
	Nome,
	SimNao_Id,
	Sigla,
	DiscCat_gsRecognize(Id) AS recognize
FROM 
  	DiscCat 
WHERE 
  	Id = nvl( p_DiscCat_Id ,0)
