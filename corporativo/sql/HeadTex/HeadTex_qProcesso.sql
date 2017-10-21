SELECT
	*
FROM
	HeadTex
WHERE
	HeadTex.IdProcesso = nvl ( p_Processo_Id , 0 )