select
  TurmaOfe.Id                           as Id,
  Turma.Codigo                          as Recognize
from
  pletivo,
  turma,
  turmaofe,
  currofe,
  curr
where
  TurmaOfe_gnUltimoAnista( TurmaOfe.Id ) = 1
and
  PLetivo.Id = CurrOfe.Pletivo_Id
and
  turma.id=turmaofe.turma_id
and
  turmaofe.currofe_id = currofe.id
and
  currofe.curr_id=curr.id
and
  (
    p_Campus_Id is null
      or
    Turma.Campus_Id  = nvl(  p_Campus_Id , 0)
  )
and
  Curr.Curso_Id = nvl( p_Curso_Id , 0)
and
  currofe.pletivo_id = nvl( p_PLetivo_Id , 0)
order by 2