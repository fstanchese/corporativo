select   
  Curr.Id,  
  Curr.Codigo as Recognize,
  PLetivo_gsRecognize(CURR.pletivo_inicial_id) as Ano_Inicio 
from   
 ( select curr.* from curr where Pletivo_Inicial_Id <= nvl ( p_PLetivo_Id , 0 ) and Curso_Id = nvl( p_Curso_Id ,0) order by pletivo_inicial_id desc ) CURR  
 Start with CURR.Id in ( select Curr.Id from Curr where Curr.Curr_Pai_Id is null ) connect by  CURR.Curr_Pai_Id = PRIOR CURR.Id 
order by Ano_Inicio