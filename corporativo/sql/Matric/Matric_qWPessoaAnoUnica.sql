select
  count(*) as total,
  matric.wpessoa_id
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
  currofe.curr_id = curr.id
and
  turmaofe.currofe_id = currofe.id
and
  matric.turmaofe_id = turmaofe.id
and
  wpessoa.id = matric.wpessoa_id
and
  currofe.pletivo_id = pletivo.id
and
  (
    PLetivo.Ano_Id = nvl ( p_Ano_Id , 0 )
    or
    p_Ano_Id is null
  )
and
  (
    Matric.MatricTi_Id = nvl ( p_MatricTi_Id , 0 )
    or
    p_MatricTi_Id is null
  )
and
  matric.wpessoa_id = nvl( p_WPessoa_Id ,0)   
group by matric.wpessoa_id
having count(*) = 1