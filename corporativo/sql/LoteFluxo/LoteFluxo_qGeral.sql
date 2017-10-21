select
	LoteFluxo.*,
	LoteFluxo_gsRecognize(LoteFluxo.Id) as Recognize
from
	LoteFluxo
order by Recognize
	