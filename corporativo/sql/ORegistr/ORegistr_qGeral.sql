SELECT
	ORegistr.*,
	OProces.CurrId     as Curr_Id,
	OProces.TempTitulo as TempTitulo_Id,
	WPessoa_gsRecognize(DRAID) as DiretorDRA, 
	WPessoa_gsRecognize(DIRETORID) as Diretor,
	WPessoa_gsRecognize(REITORID) as Reitor,
	Upper(ORegistr.NomeCurso) as NomeCurso2,
	to_char( to_date(ORegistr.DtNasce) ,'DD " de " month " de " YYYY') as Nascimento	 
FROM
	ORegistr,
	OProces
WHERE
	ORegistr.NUMREGIST in ( select NUMREGIST from ORegistr,OProces WHERE ORegistr.IdProcesso = oProces.IdProcesso AND OProces.DiplProcTi = 118900000000004 )	  
AND
	ORegistr.IdProcesso = oProces.IdProcesso
AND
	(ORegistr.IdProcesso in (511 ,11248  ) or 1=1)	
AND
	ORegistr.DiplomaId is null
ORDER BY ORegistr.NUMREGIST,ORegistr.IDPROCESSO
	