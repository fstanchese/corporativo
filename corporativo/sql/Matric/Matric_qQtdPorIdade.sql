select
  curr.curso_id as curso_id,
  substr(curso_gsrecognize(curr.curso_id),1,100) as curso,
  wpessoa_gnidade(wpessoa.id,to_date('31/12/2006')) as idade
from
  curr,
  currofe,
  turmaofe,
  matric,
  wpessoa
where 
  matric.wpessoa_id = wpessoa.id
and
  matric.matricti_id = 8300000000001
and
  (
  matric.state_id = 3000000002002
  or
  matric.state_id = 3000000002003
  )
and
  matric.turmaofe_id = turmaofe.id
and
  curr.id = currofe.curr_id
and
  turmaofe.currofe_id = currofe.id
and
  currofe.curr_id = curr.id
and
  currofe.pletivo_id = nvl( p_PLetivo_Id ,0)
order by 2
