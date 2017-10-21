select
	dexcd.id as id,
  	dexcd.currxdisc_id,
  	dexcd.discEsp_id,
  	dexcd.us|| ' - '||curr.codigo || ' - ' || disc.codigo || ' - ' ||disc.nome as recognize,
	currxdisc_gsRecognize(dexcd.currxdisc_id) as cxdrecognize,
	disc.codigo as coddisc
from
	curr,
	disc,
	currxdisc,
	discesp,
	dexcd
where
	disc.id = currxdisc.disc_id
and
	curr.id = currxdisc.curr_id
and
	currxdisc.id = dexcd.currxdisc_id
and
(
 	p_DiscEspTi_Id is null
    or
    discEsp.DiscEspTi_Id = nvl( p_DiscEspTi_Id ,0)
)
and
	discEsp.id = dexcd.discesp_id
and
  	dexcd.discEsp_id = nvl( p_DiscEsp_Id ,0)
order by 
	disc.codigo,curr.codigo