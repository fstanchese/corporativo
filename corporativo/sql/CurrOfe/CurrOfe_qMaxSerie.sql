select
  max(duracxci.sequencia) as serie
from
  currofe,
  turmaofe,
  duracxci,
  turma
where
  duracxci.id = turma.duracxci_Id
and
  turma.id = turmaofe.turma_id
and
  currofe.id = turmaofe.currofe_id
and
  currofe.curr_id = nvl ( p_Curr_Destino_Id , 0 )
and
  currofe.pletivo_id = nvl ( p_PLetivo_Replicar_Id , 0)