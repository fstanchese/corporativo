select 
currOfe.id           as ID,
curr.currnomevest as RECOGNIZE
from
cursonivel,
curso, 
currofe,
curr
where
curso.cursonivel_id = cursonivel.id
and
cursonivel.id = nvl( p_CursoNivel_Id ,0)
and
curr.curso_id = curso.id
and
currofe.curr_id = curr.id
and
currofe.periodo_id = nvl( p_Periodo_Id ,0)
and
currofe.campus_id = nvl( p_Campus_Id ,0)
and
pletivo_id = 7200000000056
order by 2