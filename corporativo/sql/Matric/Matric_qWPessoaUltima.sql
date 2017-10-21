select  
  Matric.Id, 
  CurrOfe.Periodo_Id,
  Matric.State_Id,
  Curr.Codigo,
  Curr.Id as Curr_Id,
  nvl(matric.data,trunc(sysdate)) as datax
from  
  Curr,  
  Curso,  
  CurrOfe,  
  TurmaOfe,  
  Matric 
where  
  Matric.State_Id > nvl( p_State_Id , 3000000002000 )
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
  Curso.Id = nvl ( p_Curso_Id , 0 )
and  
  Matric.WPessoa_Id = nvl( p_WPessoa_Id ,0 )
order by datax desc 
