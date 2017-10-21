select 
  WPessoa.Id as WPessoa_Id,
  Matric.Id  as Matric_Id,
  TurmaOfe.Id as TurmaOfe_Id,
  WPessoa.Codigo as Ra,
  Matric_gnEVestibulando(Matric.Id,CurrOfe.Pletivo_Id) as Ingressante
from
  wpessoa,
  matric,
  curso,
  curr,
  currofe, 
  turmaofe,
  turma
where
  matric.state_id > 3000000002001
and
  turma.id = turmaofe.turma_id
and
  curso.id = curr.curso_id
and
  curr.id = currofe.curr_id
and
  wpessoa.id = matric.wpessoa_id
and
  matricti_id = 8300000000001
and
  matric.turmaofe_id = turmaofe.id
and
  turmaofe.currofe_id = currofe.id
and
  (
    p_Campus_Id is null
    or
    currofe.campus_id = nvl ( p_Campus_Id , 0 )
  )
and
  turma.periodo_id = nvl ( p_Periodo_Id , 0 )
and 
  curso.id = nvl ( p_Curso_Id , 0 )
and
  currofe.pletivo_id = nvl ( p_PLetivo_Id , 0 )