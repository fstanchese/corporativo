SELECT
	CAAtendente.*,
	WPessoa_gsRecognize(CAAtendente.wpessoa_id) 		as WPESSOA_NOME,
	to_char(CAAtendente.DtInicio,'dd/mm/yyyy hh24:mi')	as DtInicio_Format,
	to_char(CAAtendente.DtTermino,'dd/mm/yyyy hh24:mi')	as DtTermino_Format,
	CAEvento.Id                                 		as CAEvento_Id,
	CAEvento.Campus_Id									as Campus_Id 
FROM
	CAAtendente,
	CAMesa,
	CAEvento
WHERE
	CAMesa.CAEvento_Id = CAEvento.Id
and
	CAAtendente.CAMesa_Id = CAMesa.Id
and
	CAAtendente.Id = p_CAAtendente_Id 