(
select
  pletivo.id as id,
  pletivo_gsrecognize(pletivo_id) as recognize
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
  Matric_gnEstudando( Matric.Id, p_O_Data ) = 1
and
  currofe.pletivo_id = pletivo.id
and
  turma.duracxci_id = duracxci.id (+)
and
  turmaofe.turma_id = turma.id
and
  (
    Curso.CursoNivel_Id = p_CursoNivel_Id
  or
    p_CursoNivel_Id is null
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
  wpessoa.id = matric.wpessoa_id
and
  matric.wpessoa_id = nvl( p_WPessoa_Id ,0)
)
union
(
select
  pletivo.id as id,
  pletivo_gsrecognize(pletivo_id) as recognize
from
  pletivo,
  duracxci,
  turma,
  curso,
  discesp,
  turmaofe,
  matric,
  wpessoa
where
  Matric_gnEstudando( Matric.Id, p_O_Data ) = 1
and
  discesp.pletivo_id = pletivo.id
and
  turma.duracxci_id = duracxci.id (+)
and
  (
    Curso.CursoNivel_Id = p_CursoNivel_Id
  or
    p_CursoNivel_Id is null
  )
and
  curso.id = turma.curso_Id
and
  turmaofe.turma_id = turma.id
and
  turmaofe.discesp_id = discesp.id
and
  matric.turmaofe_id = turmaofe.id
and
  wpessoa.id = matric.wpessoa_id
and
  matric.wpessoa_id = nvl( p_WPessoa_Id ,0)
)
order by 2