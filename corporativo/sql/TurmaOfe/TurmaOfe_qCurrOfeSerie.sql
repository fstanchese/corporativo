select 
turma.id as id,
turma.id as turma_id,
turma_gsrecognize(turma.id) as turma_recognize,
turma_gsrecognize(turma.id) as recognize
from
turma,
curr,
currofe,
duracxci
where 
turma.id not in ( select turma_id from turmaofe where currofe_id = nvl( p_CurrOfe_Id ,0) )
and
(
duracxci.sequencia = nvl( p_DuracXCi_Sequencia ,0) 
and
duracxci.durac_id = curr.durac_id
and
turma.duracxci_id = duracxci.id
)
and
currofe.campus_id = turma.campus_id
and
currofe.periodo_id = turma.periodo_id
and
curr.curso_id = turma.curso_id
and
currofe.curr_id = curr.id
and
currofe.id = p_currofe_id