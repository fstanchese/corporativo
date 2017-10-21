select
	CAEvento.*,
	Campus_gsRecognize(CAEvento.Campus_Id) as Campus_Recognize,
	CAEvento_gsRecognize(CAEvento.Id) as Recognize
from
	CAEvento
where
	sysdate < DtTermino
and
	(
		CAEvento.Campus_Id = p_Campus_Id
	or
		p_Campus_Id is null
	)	
order by
	Descricao