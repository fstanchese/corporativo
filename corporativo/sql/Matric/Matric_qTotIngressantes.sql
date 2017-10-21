select 
  count(wpessoa.id) as total
from
  wpessoa,
  matric,
  curso,
  curr,
  currofe, 
  turmaofe,
  turma,
  pletivo
where  
  (
    nvl( p_O_Check1 , 'off' ) = 'off'
    or
    matric_gnevestibulando( matric.id , currofe.pletivo_id ) > 0
    or
    ( substr(wpessoa.codigo,1,4) = substr(pletivo.nome,1,4) and nvl( p_O_Check1 , 'off' ) = 'on' and currofe.pletivo_id < 7200000000056)
  ) 
and
  pletivo.id=currofe.pletivo_id
and
  matric.state_id > 3000000002001
and
  turma.id=turmaofe.turma_id
and
  curso.id=curr.curso_id
and
  curr.id=currofe.curr_id
and
  wpessoa.id=matric.wpessoa_id
and
  matricti_id = 8300000000001
and
  matric.turmaofe_id=turmaofe.id
and
  turmaofe.currofe_id=currofe.id
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