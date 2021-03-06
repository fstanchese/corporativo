select 
  currOfe.id           as ID,
  curr.currnomevest    as RECOGNIZE
from
  cursonivel,
  curso, 
  currofe,
  curr
where
(
  (
    currofe.id <> 6800000003061
    and
    currofe.vest = 'on'
    and
    p_O_Check = 'off'
  )
or
  (
    currofe.prouni = 'on'
    and
    p_O_Check = 'on'
  )
or
  (
    currofe.prouni is not null
    and
    p_O_Check is null
  )
)
and
  curso.cursonivel_id = cursonivel.id
and
  (
    p_CursoNivel_Id is null
    or
    cursonivel.id = nvl( p_CursoNivel_Id ,0)
  )
and
  curr.curso_id = curso.id
and
  currofe.curr_id = curr.id
and
  (
    p_Periodo_Id is null
    or
    currofe.periodo_id = nvl( p_Periodo_Id ,0)
  ) 
and
  (
    p_Campus_Id is null
    or
    currofe.campus_id = nvl( p_Campus_Id ,0)
  )
and
  pletivo_id = nvl ( p_PLetivo_Id , 0 )
order by 2