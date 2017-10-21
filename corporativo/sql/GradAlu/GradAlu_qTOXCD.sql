select 
  GradAlu.*,
  WPessoa.Nome as WPessoa_Recognize,
  WPessoa.Codigo as Ra
from 
  GradAlu,
  Matric,
  TOXCD,
  WPessoa
where
  WPessoa.Id = GradAlu.WPessoa_Id
and
  Matric.State_Id in (3000000002002,3000000002003) 
and
  GradAlu.Matric_Id = Matric.Id
and  
  GradAlu.TurmaOfe_Id = TOXCD.TurmaOfe_Id
and
  GradAlu.CurrXDisc_Id = TOXCD.CurrXDisc_Id
and
  TOXCD.Id = nvl ( p_TOXCD_Id ,0)
order by
  WPessoa_Recognize