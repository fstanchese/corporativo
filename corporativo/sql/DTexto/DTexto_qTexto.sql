SELECT
	*
FROM
	DTexto
WHERE
 	DTexto.IdTexto = nvl ( p_Texto_Id , 0 )
ORDER BY Ln_Seq 	