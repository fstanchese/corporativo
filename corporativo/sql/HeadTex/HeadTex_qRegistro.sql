SELECT
	*
FROM
	HeadTex
WHERE
	HeadTex.IdRegistro = nvl ( p_Registro_Id , 0 )