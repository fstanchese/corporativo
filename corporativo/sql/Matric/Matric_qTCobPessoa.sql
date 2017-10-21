select
  turmaofe_gsretpletivo(matric.turmaofe_id) as ano,
  matric.id              as id,
  matricti_id            as matricti_id,
  wpessoa.codigo         as codigo,
  Upper (wpessoa.nome)   as nome,
  Upper (curso.nome)     as curso,
  turmaofe_gsretcodturma(matric.turmaofe_id)  as  turma,
  matric.data            as datax,
  matric.state_id        as state_id,
  matric.rematricula     as rematricula,
  curso.id               as curso_id,
  duracxci.sequencia     as Serie,
  Decode ( Curso.CursoNivel_Id , 6200000000002, '999999999' , 6200000000008 , '999999999' , to_Char( ( Curso.Id - 5700000000000 ) , '099999999') ) as TCobCurso
from
  pletivo,
  duracxci,
  turma,
  curr,
  curso,
  currofe,
  turmaofe,
  matric,
  wpessoa
where
  ( 
    p_State_Id is null 
  or 
    nvl ( p_State_Id , 0 ) = matric.state_id 
  ) 
and
  currofe.pletivo_id = pletivo.id
and
  turma.duracxci_id = duracxci.id (+)
and
  turmaofe.turma_id = turma.id
and
  curso.cursonivel_id in (6200000000001,6200000000003,6200000000010)
and
  curr.curso_id = curso.id
and
  (
    currofe.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
  or
    p_PLetivo_Id is null
  )
and
  currofe.curr_id = curr.id
and
  turmaofe.currofe_id = currofe.id
and
  matric.turmaofe_id = turmaofe.id
and
  wpessoa.id = matric.wpessoa_id
and
  Matric.MatricTi_Id = 8300000000001
and
  matric.wpessoa_id = nvl( p_WPessoa_Id ,0)
and
  (
    matric.id = nvl ( p_Matric_Id , 0 )
  or
    p_Matric_Id is null
  )
order by 9