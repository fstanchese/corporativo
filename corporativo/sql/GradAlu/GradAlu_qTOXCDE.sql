select 
  GradAlu.*,
  WPessoa_gsRecognize(GradAlu.WPessoa_Id) as WPessoa_Recognize
from 
  GradAlu,
  Matric
where
  GradAlu.Matric_Id = Matric.Id
and
  Matric.State_Id in (3000000002002,3000000002003) 
and  
  GradAlu.TurmaOfe_Id = TOXCD_gnRetTurmaOfe( p_TOXCD_Id )
order by
  WPessoa_Recognize