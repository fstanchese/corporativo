(
select
  currofe.periodo_id,  
  currofe.pletivo_id,
  periodo_gsrecognize(currofe.periodo_id) as periodo_r,
  pletivo_gsrecognize(currofe.pletivo_id) as recognize,
  campus_gsrecognize(turma.campus_id) as campus
from  
  turma,
  currofe,
  turmaofe
where  
  turma.id = turmaofe.turma_id
and
  currofe.id = turmaofe.currofe_id
and
  turmaofe.id = nvl( p_TurmaOfe_Id ,0) 
)
union
(
select
  turma.periodo_id,  
  discesp.pletivo_id,
  periodo_gsrecognize(turma.periodo_id) as periodo_r,
  pletivo_gsrecognize(pletivo_id) as recognize,
  campus_gsrecognize(turma.campus_id) as campus
from
  turma,  
  discesp,
  turmaofe
where
  turmaofe.turma_id = turma.id
and  
  discesp.id = turmaofe.discesp_id
and
  turmaofe.id = nvl( p_TurmaOfe_Id ,0) 
)
