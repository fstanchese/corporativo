select 
  Turma.Id as Id,
  Turma.Id as Turma_Id,
  Turma_gsRecognize(Turma.Id) as turma_recognize,
  Turma_gsRecognize(Turma.Id) as recognize
from
  Turma
where
  Turma.Id not in ( select Turma_Id from TurmaOfe,DiscEsp Where TurmaOfe.DiscEsp_Id = DiscEsp.Id and DiscEsp.Pletivo_Id = nvl( p_PLetivo_Id ,0) )
and
  Turma.TurmaTi_Id = 6600000000002
and
  p_DiscEsp_Id is not null
order by Recognize
  
