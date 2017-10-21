select
  PLetivo.Nome as PLetivoNome
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
  matric.state_id = 3000000002012
and
  duracxci.sequencia = nvl ( p_DuracXCi_Sequencia , 0 )
and
  currofe.pletivo_id = pletivo.id
and
  turma.duracxci_id = duracxci.id
and
  turmaofe.turma_id = turma.id
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
  wpessoa.id = matric.wpessoa_id
and
  matric.wpessoa_id = nvl( p_WPessoa_Id ,0 )
and
  Curso.Id = nvl ( p_Curso_Id , 0 )
