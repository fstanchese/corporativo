SELECT 
	Curr.*,
	Curr_gsRecognize(Curr.Id)                                        as Curr_Id_r,
	Curso_gsRecognize(Curso_Id)                                      as Curso,
	Curso.Facul_Id                                                   as Facul_Id,
	Curso.NomeRed                                                    as NomeRed,
	Curr_gsRetCodCurr(Curr.Curr_Pai_Id)                              as CODIGOCURRPAI,
	Curr_gsRecognize(Curr.Id)                                        as Recognize,
	currnomehist||decode(CurrNivelDesc,null,'',' - ')||CurrNivelDesc as CurrNome,
	WPessoa_gsRecognize(Curso_gnCoordenador(Curso_Id,null))          as Coordenador,
	Curso.cursonivel_id,
	Curr.CurrNomeHist || decode(Curr.CurrCompNome,null,'',' - ' || Curr.CurrCompNome) || decode(Curr.CurrNivelDesc,null,'',' - ' || Curr.CurrNivelDesc) as NomeCurso,
	Upper(Curr.CURRNOMEDIPL)     as CurrDiplUpper,
	Upper(Curr.CurrNomeApostila) as CurrApostila,
	Upper(Curr.CurrNomeVerso)    as CurrVersoUpper,
	Upper(Curr.CURRCOMPNOME)     as CurrCompUpper
FROM 
	Curr, 
	Curso
WHERE 
	Curr.curso_id = curso.id
AND
	Curr.Id = nvl( p_Curr_Id ,0 )
