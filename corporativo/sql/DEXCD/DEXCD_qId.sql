select
	dexcd.*,
  	dexcd_gsRecognize(dexcd.id) as recognize,
  	currxdisc_gsRecognize(currxdisc_id) as currxdisc_id_r
from
  	dexcd
where
	dexcd.id = nvl( p_DEXCD_Id ,0)
