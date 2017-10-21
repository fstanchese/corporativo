select
	CAAssunto.*,
	CAEvento_gsRecognize(CAAssunto.CAEvento_Id) as CAEvento_Recognize,
	CAAssunto_gsRecognize(CAAssunto.Id)         as Recognize
from
	CAAssunto
where
	(
		CAAssunto.CAEvento_Id = p_CAEvento_Id
	or
		p_CAEvento_Id is null
	)	
order by
	CAEvento_Recognize, Descricao