select
	LoteProc.*,
	LoteProc_gsRecognize(LoteProc.Id) as recognize
from
	LoteProc
where
	LoteProc.Id = p_LoteProc_Id 