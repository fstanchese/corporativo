select
	LoteFluxo.*,
	LoteFluxo_gsRecognize(LoteFluxo.Id) as Recognize
from
	LoteFluxo
where
	LoteFluxo.Id = p_LoteFluxo_Id 