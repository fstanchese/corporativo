select 
  turmaofe.id,
  turma_gsrecognize(turma_id) as recognize
from
  turmaofe,
  currofe,
  turma
where
  turmaofe.currofe_id = nvl( p_TurmaOfe_CurrOfe_Id ,0) 
and
  currofe.pletivo_id = nvl( p_PLetivo_Id ,0) 
and
  turmaofe.currofe_id = currofe.id
and
  turma.id = turmaofe.turma_id
and
  turma.duracxci_id = nvl( p_Turma_DuracXCi_Id ,0) 
order by
  2
