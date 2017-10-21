select   
  Curr.Id,  
  Curr.Codigo as Recognize,
  PLetivo_gsRecognize(CURR.pletivo_inicial_id) as Ano_Inicio 
from   
  curr
where
  curr.curso_id = nvl ( p_Curso_Id , 0 )
and
  CURR.pletivo_inicial_id <= nvl ( p_PLetivo_Id , 0 )
order by 2