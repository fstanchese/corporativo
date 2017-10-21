SELECT
	Curr.*,
	PLetivo.Nome AS CurrInicio, 
	trim(Curr_Pai.Codigo) AS PAI,
	trim(Curr.Codigo)     AS FILHO
FROM
    PLetivo,
	curr,
	( SELECT Id, CODIGO FROM curr ) Curr_Pai
WHERE
	PLetivo.Id=Curr.PLetivo_Inicial_Id
AND
	Curr.Curr_Pai_Id = Curr_Pai.Id (+)
AND
	Curr.Curso_id = nvl ( p_Curso_Id , 0 )
ORDER BY 
	PLetivo_Inicial_Id DESC,PAI, FILHO
