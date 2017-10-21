SELECT
	*
FROM
	OProces
WHERE
	OProces.IDPROCESSO = nvl ( p_Processo_Id , 0 )
ORDER BY NrProcesso	