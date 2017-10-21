
select  
  Id, 
  Nome, 
  Periodo_gsRecognize(Id) as Recognize 
from  
  Periodo  
where  
  Id = nvl( p_Periodo_Id ,0)
