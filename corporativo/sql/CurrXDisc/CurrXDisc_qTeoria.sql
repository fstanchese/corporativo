SELECT  
	CurrXDisc.Id,
	CurrXDisc_gsRetCodDisc(CurrXDisc.Id)||' - '||CurrXDisc_gsRetDisc(CurrXDisc.Id) || ' - ' || DiscCat_Id AS Recognize
FROM
	DuracXCi,
	CurrXDisc,
	Curr
WHERE
	DuracXCi.Sequencia = nvl( p_DuracXCi_Sequencia , 0 )
AND
	DuracxCi.Id = CurrXDisc.DuracXCi_Id
AND
	( CurrXDisc.DiscCat_Id < 5900000000003 or Curr.Curso_Id = 5700000000036 )
AND
	Curr.Id = CurrXDisc.Curr_Id
AND 
	Curr_Id = nvl( p_Curr_Id ,0 )
ORDER BY
	Recognize