select 
  GradAlu.Id             as GradAlu_Id,
  WPessoa.Nome           as NomeAluno,
  WPessoa.Codigo         as Ra,
  TempGradAlu.State_Id   as State_Temp_Id,
  TempGradAlu.Confirmado as Confirmado
from 
  GradAlu,
  Matric,
  WPessoa,
  TempGradAlu
where
  TempGradAlu.GradAlu_Id (+)= GradAlu.Id 
and
  WPessoa.Id = GradAlu.WPessoa_Id
and
  GradAlu.State_Id <> 3000000003002
and
  Matric.State_Id in (3000000002002,3000000002003,3000000002010,3000000002011) 
and
  GradAlu.Matric_Id = Matric.Id
and  
  GradAlu.TurmaOfe_Id = nvl ( p_TurmaOfe_Id , 0 )
and
  GradAlu.CurrXDisc_Id = nvl ( p_CurrXDisc_Id , 0 )
order by NomeAluno