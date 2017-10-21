SELECT 
	CURR.*,
	Curr.Codigo || ' - ' || Curr.CurrNomeHist || Decode(CurrCompNome,null,'',' - '||CurrCompNome ) || decode(Curr.CurrNivel_Id,7400000000001,' - '||Curr.CurrNivelDesc,7400000000002,null,7400000000003,' - '||CurrNivelDesc) AS Recognize,
	Curr_gsRecognize(CURR.Curr_Pai_Id)               AS PaiRecognize,
	Durac_gsRecognize(CURR.Durac_Id)                 AS Durac_Recognize,
	PLetivo_gsRecognize(CURR.pletivo_inicial_id)     AS Ano_Inicio,
	Titulo_gsRecognize(CURR.Titulo_Id)               AS Titulo,
	nvl(PLetivo_gsRecognize(CURR.PLetivo_Final_Id),' - ')   AS Ano_Final,
	Curr_gsRecognize(CURR.Id) as Recognize_Show
FROM 
  	Curr
WHERE 
	Curr.Curr_Pai_Id IS NULL
AND
  	Curr.Curso_Id = nvl( p_Curso_Id ,0)
ORDER BY 
	Ano_Inicio,Recognize Desc
