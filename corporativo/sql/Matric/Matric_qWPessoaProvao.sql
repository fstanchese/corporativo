select
  matric.id,
  pletivo_gsrecognize(currofe.pletivo_id) || ' - ' || turmaofe_gsrecognize(turmaofe.id) as recognize,
  matric.data as datax
from
  matric,
  turmaofe,
  currofe,
  curr
where
  curr.id = currofe.curr_id
and
  currofe.id = turmaofe.currofe_id
and
  turmaofe.id = matric.turmaofe_id
and
  matric.state_id in (3000000002002,3000000002003,3000000002010,3000000002011,3000000002012)
and
  matric.matricti_id = 8300000000001
and
  matric.wpessoa_id = nvl( p_WPessoa_Id ,0)
order by 3 desc