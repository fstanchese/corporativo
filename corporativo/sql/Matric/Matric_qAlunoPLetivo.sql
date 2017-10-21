(
select
  matric.*,
  turmaofe_gsrecognize(turmaofe.id)               as turmaofe_recognize,
  to_char(rematricula,'dd/mm/yyyy "as" hh24:mi')  as rematriculax,
  curso.facul_id                                  as Facul_Id,
  Curso.Nome                                      as Curso,
  state_gsRecognize(Matric.State_Id)              as State_Recognize,
  Matric.State_Id                                 as Matric_State_Id
from
  wpessoa,
  currofe,
  turmaofe,
  matric,
  curr,
  curso
where
  (
    matric.State_Id = p_State_Id 
  or
    p_State_Id is null
  )
and
  curr.curso_id = curso.id
and
  currofe.curr_id = curr.id
and
  turmaofe.currofe_id = currofe.id
and
  matric.turmaofe_id = turmaofe.id
and
  matric.matricTi_id = 8300000000001
and
  matric.state_id > 3000000002000
and
  wpessoa.id = matric.wpessoa_id
and
  currofe.pletivo_id = nvl( p_PLetivo_Id ,0)
and
  wpessoa_id = nvl( p_WPessoa_Id ,0)
)
union
(
select
  matric.*,
  turmaofe_gsrecognize(turmaofe.id)               as turmaofe_recognize,
  to_char(rematricula,'dd/mm/yyyy "as" hh24:mi')  as rematriculax,
  null                                            as facul_id,
  null                                            as Curso,
  state_gsRecognize(Matric.State_Id)              as State_Recognize,
  Matric.State_Id                                 as Matric_State_Id
from
  wpessoa,
  discesp,
  turmaofe,
  matric
where
  (
    matric.State_Id = p_State_Id 
  or
    p_State_Id is null
  )
and
  turmaofe.discesp_id = discesp.id
and
  matric.turmaofe_id = turmaofe.id
and
  matric.matricTi_id = 8300000000002
and
  wpessoa.id = matric.wpessoa_id
and
  discesp.pletivo_id = nvl( p_PLetivo_Id ,0)
and
  wpessoa_id = nvl( p_WPessoa_Id ,0)
)
order by Matric_State_Id