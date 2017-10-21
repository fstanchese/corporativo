(
select
  duracxci.sequencia as sequencia,
  curr.id            as curr_id,
  matric.*,
  wpessoa_gsRecognize (matric.wpessoa_id)  as nomeAluno,
  turmaofe_gsrecognize(matric.turmaofe_id) as turmaofe
from
  duracxci,
  curso,
  turma,
  curr,
  turmaofe,
  currofe,
  matric
where
  matric.matricTi_id = 8300000000001
and
  matric_gnReprovado( matric.id ) = 1
and
  turma.duracxci_id = duracxci.id 
and
  turmaofe.turma_id = turma.id
and
  matric.turmaofe_id = turmaofe.id
and
  turmaofe.currofe_id = currofe.id
and
  currofe.curr_id = curr.id
and
  curr.curso_id = curso.id
and
  (
   p_curso_idrecognize is null or curso.id = nvl( p_curso_idrecognize ,0)
  )
and
  duracxci.sequencia = nvl( p_duracxci_serieUnica_id ,0)
and
  curso.cursonivel_id = nvl( p_cursonivel_id ,0)
and
  currofe.pletivo_id = nvl( p_pletivo_id ,0)  
)
union
(
select
  duracxci.sequencia as sequencia,
  curr.id            as curr_id,
  matric.*,
  wpessoa_gsRecognize (matric.wpessoa_id)  as nomeAluno,
  turmaofe_gsrecognize(matric.turmaofe_id) as turmaofe
from
  duracxci,
  curso,
  turma,
  curr,
  turmaofe,
  currofe,
  matric
where
  matric.matricTi_id = 8300000000001
and
  matric_gnAprovado ( matric.id ) = 1
and
  turma.duracxci_id = duracxci.id 
and
  turmaofe.turma_id = turma.id
and
  matric.turmaofe_id = turmaofe.id
and
  turmaofe.currofe_id = currofe.id
and
  currofe.curr_id = curr.id
and
  curr.curso_id = curso.id
and
  (
   p_curso_idrecognize is null or curso.id = nvl( p_curso_idrecognize ,0)
  )
and
  duracxci.sequencia = p_duracxci_serieUnica_id - 1
and
  curso.cursonivel_id = nvl( p_cursonivel_id ,0)
and
  currofe.pletivo_id = nvl( p_pletivo_id ,0)
)
union
(
select
  duracxci.sequencia as sequencia,
  curr.id            as curr_id,
  matric.*,
  wpessoa_gsRecognize (matric.wpessoa_id)  as nomeAluno,
  turmaofe_gsrecognize(matric.turmaofe_id) as turmaofe
from
  duracxci,
  curso,
  turma,
  curr,
  turmaofe,
  currofe,
  matric
where
  matric.matricTi_id = 8300000000001
and
  matric_gnAprovado( matric.id ) = 1
and
  turma.duracxci_id = duracxci.id 
and
  turmaofe.turma_id = turma.id
and
  matric.turmaofe_id = turmaofe.id
and
  turmaofe.currofe_id = currofe.id
and
  currofe.curr_id = curr.id
and
  curr_gnProximaSerie ( curr.id, duracxci.sequencia ) is null
and
  curr.curso_id = curso.id
and
  (
   p_curso_idrecognize is null or curso.id = nvl( p_curso_idrecognize ,0)
  )
and
  duracxci.sequencia = p_duracxci_serieUnica_id
and
  curso.cursonivel_id = nvl( p_cursonivel_id ,0)
and
  currofe.pletivo_id = nvl( p_pletivo_id ,0)
)
order by
  turmaofe
