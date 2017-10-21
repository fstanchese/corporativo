select 
  turmaofe.id,
  turma_gsrecognize(turma_id) as recognize
from
  turmaofe,
  currofe
where 
  turmaofe.currofe_id = currofe.id
and
  currofe.pletivo_id = nvl( p_PLetivo_Id ,0) 
order by
  2