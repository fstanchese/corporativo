select 
  turmaofe.id,
  currofe_id,
  turma_id,  
  turma_gsrecognize(turma_id) as recognize,
  curso_gsrecognize(curso.id) as curso_r
from
  duracxci,
  turma,
  turmaofe,
  curso,
  curr,
  currofe
where 
  currofe.provao='on'
and
  duracxci.id = turma.duracxci_id
and
  turma.id = turmaofe.turma_id
and
  turmaofe_gnUltimoAnista(turmaofe.id)=1
and
  turmaofe.currofe_id = currofe.id
and
  curso.id = curr.curso_id
and
  curr_gnProximaSerie(curr.id) is null
and
  curr.id = currofe.curr_id
and
  currofe.pletivo_id = nvl( p_PLetivo_Id ,0) 
order by 4
  
