select  
  Count(Curso.Id) as Total,
  Curso.Id as Id,  
  Curso_gsRecognize(Curso.Id) as Recognize 
from  
  Curr,  
  Curso,  
  CurrOfe,  
  TurmaOfe,  
  Matric 
where  
  Matric.State_Id > p_Matric_State_Id
and
  Curso.Id = Curr.Curso_Id 
and  
  Curr.Id = CurrOfe.Curr_Id 
and  
  CurrOfe.Id = TurmaOfe.CurrOfe_Id 
and  
  Matric.TurmaOfe_Id = TurmaOfe.Id 
and  
  Matric.MatricTi_Id = 8300000000001 
and  
  Matric.WPessoa_Id = nvl( p_WPessoa_Id ,0)
group by Curso.Id