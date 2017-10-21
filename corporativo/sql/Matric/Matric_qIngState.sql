select 
  count(*) as total
from
  wpessoa,
  matric,
  curso,
  curr,
  currofe, 
  turmaofe,
  turma
where
  turma.id=turmaofe.turma_id
and
  curso.id=curr.curso_id
and
  curr.id=currofe.curr_id
and
  wpessoa.codigo like '$v_ano'
and
  wpessoa.id=matric.wpessoa_id
and
  matricti_id = 8300000000001
and
  matric.turmaofe_id=turmaofe.id
and
  turmaofe.currofe_id=currofe.id
and
  turma.periodo_id = nvl ( p_Periodo_Id , 0 )
and
  curso.id = nvl ( p_Curso_Id , 0 )
and
  matric.state_id = nvl ( p_State_Id , 0 )