select
  count(*) as total,
  wpessoa.codigo,
  matric.state_id
from
  curso,
  curr,
  matric,
  currofe,
  turmaofe,
  wpessoa
where
  curr.curso_id=curso.id
and
  matric.wpessoa_id=wpessoa.id
and
  matric.state_id > 3000000002001
and
  matricti_id=8300000000001
and
  currofe.curr_id=curr.id
and
  matric.turmaofe_id=turmaofe.id
and
  turmaofe.currofe_id=currofe.id
and
  currofe.pletivo_id = nvl ( p_PLetivo_Id , 0 )
and
  matric.wpessoa_id = nvl ( p_WPessoa_Id , 0 )
group by wpessoa.codigo,matric.state_id
having count(*) > 1
order by state_id