(
select 
  turmaofe.id,
  currofe_id,
  turma_id,
  turma_gsrecognize(turma_id) as recognize,
  turma.TurmaTi_Id            as TurmaTi_Id,
  turmaofe.id                 as TurmaOfe_Id
from
  turma,
  turmaofe,
  currofe,
  curr, 
  curso
where
(
  p_TurmaTi_Id is null
    or
  turma.turmati_id = nvl( p_TurmaTi_Id ,0)
)
and
  turma.id = turmaofe.turma_id
and
  turmaofe.currofe_id = currofe.id
and
  curso.cursonivel_id = nvl( p_CursoNivel_Id , 0 )
and
  curso.id = curr.curso_id
and
  curr.id = currofe.curr_id
and
  currofe.pletivo_id = nvl( p_PLetivo_Id ,0) 
)
union
(
select 
  turmaofe.id,
  currofe_id,
  turma_id,
  turma_gsrecognize(turma_id) as recognize,
  turma.TurmaTi_Id            as TurmaTi_Id,
  turmaofe.id                 as TurmaOfe_Id
from
  turma,
  turmaofe,
  discesp,
  currofe,
  curr,
  curso
where 
(
  p_TurmaTi_Id is null
    or
  turma.turmati_id = nvl( p_TurmaTi_Id ,0) 
)
and
  curso.cursonivel_id = nvl( p_CursoNivel_Id , 0 )
and
  curso.id = curr.curso_id
and
  curr.id = currofe.curr_id
and 
  currofe.id = turmaofe.currofe_id
and
  turma.id = turmaofe.turma_id
and
  turmaofe.discEsp_id = discEsp.id
and
  discEsp.pletivo_id = nvl( p_PLetivo_Id ,0)
)
order by
  4
