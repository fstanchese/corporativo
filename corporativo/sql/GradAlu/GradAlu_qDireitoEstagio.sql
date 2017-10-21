select
  count(disccat_id) as totalcat,
  max(pletivo.nome) as Ultimo,
  min(pletivo.nome) as Primeiro,
  max(pletivo.id)   as Ultimo_id,
  min(pletivo.id)   as Primeiro_id
from
  gradalu,
  currxdisc,
  currofe,
  turmaofe,
  pletivo
where
  gradalu.state_id = 3000000003004
and
  currxdisc.disccat_id in (5900000000003,5900000000004,5900000000011)
and
  gradalu.currxdisc_id = currxdisc.id
and
  pletivo.id = currofe.pletivo_id
and
  currofe.id = turmaofe.currofe_id
and
  turmaofe.id = gradalu.turmaofe_id
and
  gradalu.wpessoa_id = nvl( p_WPessoa_Id , 0)


