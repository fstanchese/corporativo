select
	Lote.*,
	Lote_gsRecognize(Lote.Id) as Recognize
from
	Lote
where
	Lote.Id = p_Lote_Id 