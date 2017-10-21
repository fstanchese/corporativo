SELECT
	*
FROM
	OProces
WHERE
	OProces.IDPRONTUA = nvl ( p_Prontua_Id , 0 )
ORDER BY NrProcesso	