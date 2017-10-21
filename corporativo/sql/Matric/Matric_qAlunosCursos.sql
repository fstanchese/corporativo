select
  count(matric.id) as ALUNOS,
  curr.curso_id
from
  curr,
  currofe,
  turmaofe,
  matric
where 
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
group by curr.curso_id