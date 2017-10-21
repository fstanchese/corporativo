
select 
  turmaofe.id,
  turma_gsrecognize(turma_id) as turma_recognize,
  turma_gsrecognize(turma_id) as recognize
from
  turmaofe,
  turma
where 
  duracxci_gnRetSequencia(turma.duracxci_id) = nvl( p_DuracXCi_Sequencia ,0) 
and
  turma.id = turmaofe.turma_id 
and
  turmaofe.currofe_id = nvl( p_CurrOfe_Id ,0) 
order by
  2