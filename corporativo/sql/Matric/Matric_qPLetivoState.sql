select
  wpessoa.codigo,
  wpessoa.id as wpessoa_id,
  wpessoa.nome,
  matric.id as matric_id
from
  wpessoa,
  currofe,
  turmaofe,
  matric,
  curr,
  curso
where
  curr.curso_id = curso.id
and
  currofe.curr_id = curr.id
and
  turmaofe.currofe_id = currofe.id
and
  matric.turmaofe_id = turmaofe.id
and
  matric.matricti_id = 8300000000001
and
  wpessoa.id = matric.wpessoa_id
and
  (
     p_CursoNivel_Id is null
     or
     Curso.CursoNivel_Id = nvl ( p_CursoNivel_Id , 0 )
  )
and 
  (
    p_Curso_Id is null
    or
    curso.id = nvl ( p_Curso_Id , 0 )
  )
and
  (
    p_State_Id is null
    or
    matric.state_id = nvl ( p_State_Id , 0 )
  )
and
  currofe.pletivo_id = nvl( p_PLetivo_Id ,0 )
order by wpessoa.nome