oDoc ( ) 

select 
  Moeda.*, 
  Moeda_gsRecognize(Id) "MOEDA" 
from 
  Moeda 
where 
  Id = nvl( p_Moeda_Id ,0) 
