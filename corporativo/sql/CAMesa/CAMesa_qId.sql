select
	CAMesa.*,
	CAMesa_gsRecognize(CAMesa.Id)            as Recognize,
	CAEvento_gsRecognize(CAMesa.CAEvento_Id) as CAEvento_Recognize,
	Sala_gsRecognize(Sala_Id)                as Sala_Recognize,
	CAEvento.Campus_Id                       as Campus_Id,
	Campus_gsRecognize(CAEvento.Campus_Id)   as Campus_Recognize
from
	CAMesa,
	CAEvento
where
	CAMesa.CAEvento_Id = CAEvento.Id
and
	CAMesa.Id = p_CAMesa_Id 