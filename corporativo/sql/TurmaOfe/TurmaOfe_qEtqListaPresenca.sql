(
select 
  turmaofe.id,
  currofe_id,
  turma_id,
  turma_gsrecognize(turma_id) as recognize,
  turma.TurmaTi_Id            as TurmaTi_Id,
  turmaofe.id                 as TurmaOfe_Id,
  upper(Curso.NomeRed)        as Curso_Nome
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
  (
    CurrOfe.Campus_Id = p_Campus_Id 
  or
    p_Campus_Id is null
  )
and
  turmaofe.currofe_id = currofe.id
and
  curso.cursonivel_id = nvl( p_CursoNivel_Id , 0 )
and
  (
    Curso.Id = p_Curso_Id
  or
    p_Curso_Id is null
  )
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
  turmaofe.id                 as TurmaOfe_Id,
  upper(Curso.NomeRed)        as Curso_Nome
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
  (
    Curso.Id = p_Curso_Id
  or
    p_Curso_Id is null
  )
and
  curso.id = curr.curso_id
and
  (
    CurrOfe.Campus_Id = p_Campus_Id 
  or
    p_Campus_Id is null
  )
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
  7,4
