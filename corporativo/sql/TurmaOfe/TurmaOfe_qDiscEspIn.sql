
select 
  Turmaofe.Id,
  Turma_gsRecognize(Turma_Id)                as Turma_Recognize,
  TurmaOfe_gsRecognize(TurmaOfe.Id)          as Recognize,
  DuracXCi_gnRetSequencia(Turma.DuracXCi_Id) as Sequencia
from
  Turma,
  Turmaofe
where 
  Turmaofe.Turma_Id = Turma.Id
and
  TurmaOfe.DiscEsp_Id = nvl( p_DiscEsp_Id ,0) 
order by
  2