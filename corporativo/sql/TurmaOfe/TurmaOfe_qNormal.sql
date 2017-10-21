select 
  TurmaOfe.Id,
  Turma_Id,
  substr(Turma_gsRecognize(Turma_Id),1,10) as Recognize
from
  CurrOfe,
  Turma,
  TurmaOfe,
  Curr
where 
  Turma.Id = TurmaOfe.Turma_Id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  Curr.Curso_Id = nvl( p_Curso_Id ,0)
and
  CurrOfe.Curr_id = Curr.Id
and
  (
    p_Campus_Id is null
      or 
    Turma.Campus_Id = nvl( p_Campus_Id ,0)
  )
and
  (
    p_Periodo_Id is null
      or 
    CurrOfe.Periodo_Id = nvl( p_Periodo_Id ,0)
  )
and
  CurrOfe.pLetivo_Id = nvl( p_PLetivo_Id ,0) 
order by 3