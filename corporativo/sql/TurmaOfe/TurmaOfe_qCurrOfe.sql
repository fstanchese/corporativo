select 
  Turma.Id as Id,
  Turma.Id as Turma_Id,
  Turma_gsRecognize(Turma.Id) as Turma_Recognize,
  Turma_gsRecognize(Turma.Id) as Recognize
from
  Turma,
  Curr,
  CurrOfe
where 
  Turma.Id not in ( select Turma_Id from TurmaOfe,CurrOfe Where TurmaOfe.CurrOfe_Id = CurrOfe.Id and CurrOfe.Pletivo_Id = nvl( p_PLetivo_Id ,0) )
and
  CurrOfe.Campus_Id = Turma.Campus_Id
and
  CurrOfe.Periodo_Id = Turma.Periodo_Id
and
  Curr.Curso_Id = Turma.Curso_Id
and
  CurrOfe.Curr_Id = Curr.Id
and
  CurrOfe.Id = nvl( p_CurrOfe_Id ,0) 
order by 3
