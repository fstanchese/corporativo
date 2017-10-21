select
	CAMesa.*,
	CAMesa_gsRecognize(CAMesa.Id)            as Recognize,
	CAEvento_gsRecognize(CAMesa.CAEvento_Id) as CAEvento_Recognize,
	Sala_gsRecognize(Sala_Id)                as Sala_Recognize
from
	CAMesa
where
	(
		CAMesa.CAEvento_Id = p_CAEvento_Id
	or
		p_CAEvento_Id is null 
	)		
order by 
	CAEvento_gsRecognize(CAEvento_Id), Numero