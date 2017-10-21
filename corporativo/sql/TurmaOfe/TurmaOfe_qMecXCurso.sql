select
  TurmaOfe.Id as Id,
  TurmaOfe_gsRecognize(TurmaOfe.Id) || ' - ' || TurmaOfe_gsRetCodCurr(TurmaOfe.Id) as Recognize
from 
  DuracXCi, 
  Turma,
  TurmaOfe,
  CurrOfe,
  Curso,
  Curr
where
  (
     p_DuracXCi_Sequencia is null
       or
     DuracXCi.Sequencia = nvl( p_DuracXCi_Sequencia , 0)
  )  
and
  DuracXCi.Id = Turma.DuracXCi_Id
and
  Turma.Id = TurmaOfe.Turma_Id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  CurrOfe.Curr_Id = Curr.Id
and
  Curr.Curso_Id = Curso.Id
and
  (
     p_Curr_Id is null
       or
     Curr.Id = nvl ( p_Curr_Id , 0)
  )
and
  (
     p_Campus_Id is null
       or
     Turma.Campus_Id = nvl ( p_Campus_Id , 0)
  )
and
  Curr.Curso_Id = nvl( p_Curso_Id ,0)
and
  Currofe.Pletivo_id = nvl( p_PLetivo_Id ,0)
order by recognize