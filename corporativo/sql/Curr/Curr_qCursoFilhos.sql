SELECT 
	CURR.*,
	Curr.Codigo || ' - ' || Curr.CurrNomeHist || decode(Curr.CurrNivel_Id,7400000000001,' - '||Curr.CurrNivelDesc,7400000000002,null,7400000000003,' - '||CurrNivelDesc) AS Recognize,
	Curr_gsRecognize(CURR.Curr_Pai_Id)               AS PaiRecognize,
	Durac_gsRecognize(CURR.Durac_Id)                 AS Durac_Recognize,
	PLetivo_gsRecognize(CURR.pletivo_inicial_id)     AS Ano_Inicio,
	Titulo_gsRecognize(CURR.Titulo_Id)               AS Titulo,
	nvl(PLetivo_gsRecognize(CURR.PLetivo_Final_Id),' - ') AS Ano_Final,
	replace(lpad(' ',(level*3)-3),' ','&nbsp')||Curr_gsRecognize(CURR.Id) AS Recognize_Show
FROM 
  	Curr
Start WITH Curr.Curr_Pai_Id IN ( SELECT Curr.Id FROM Curr WHERE Curr.Id = nvl ( p_Curr_Pai_Id ,0 ) ) connect BY CURR.Curr_Pai_Id = PRIOR CURR.Id 
ORDER BY 
	Curr.Posicionamento,Curr.Codigo