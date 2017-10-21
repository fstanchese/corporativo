select
  turmaofe.id  as turmaofe_id,
  turma.codigo as turma
from
  duracxci,
  campus,
  periodo,
  sala,
  turmaofe,
  turma,
  facul,
  curso,
  currofe,
  curr,
  pLetivo
where
  turma.duracxci_id=duracxci.id
and
  campus.id=currofe.campus_id
and
  curso.facul_id = facul.id
and
  turma.periodo_id = periodo.id
and
  turma.curso_id = curso.id
and
  turmaofe.sala_id = sala.id (+)
and
  turmaofe.turma_id = turma.id
and
  turmaofe.currofe_id = currofe.id
and
  currofe.curr_id = curr.id
and
  currofe.pLetivo_id = pLetivo.id
and
  (
     p_Periodo_Id is null
     or
     CurrOfe.Periodo_Id = nvl ( p_Periodo_Id ,0)
  )
and
  (
    p_Campus_Id is null
    or
    CurrOfe.Campus_Id = nvl ( p_Campus_Id ,0)
  )
and
  (
     p_Facul_Id is null
     or
     Curso.Facul_Id = nvl ( p_Facul_Id , 0)
  )
and
  pLetivo.id = nvl( p_PLetivo_Id ,0)
and
  ( 
    p_Curso_Id is null 
    or
    curso.id = nvl( p_Curso_Id ,0) 
  )
order by 2