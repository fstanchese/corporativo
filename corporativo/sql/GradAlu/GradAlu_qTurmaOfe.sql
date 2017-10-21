select
  count(*),
  GradAlu.Wpessoa_Id,
  Matric.MatricTi_Id,
  WPessoa_gsRecognize(GradAlu.WPessoa_Id) as Aluno 
from
  GradAlu,
  Matric
where
  Matric.State_Id not in ( 3000000002000,3000000002004,3000000002005,3000000002006,3000000002013,3000000002008 )
and
  GradAlu.Matric_Id = Matric.Id
and
  GradAlu.State_Id <> 3000000003002 
and
  GradAlu.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0) 
group by GradAlu.WPessoa_Id,Matric.MatricTi_Id
order by 4
