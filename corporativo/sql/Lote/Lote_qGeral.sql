select
	Lote.*,
	Lote_gsRecognize(Lote.Id) as Recognize
from
	Lote
order by 
	Recognize