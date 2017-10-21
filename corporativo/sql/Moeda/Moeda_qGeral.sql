oDoc ( ) 

select 
  Id, 
  Nome, 
  Moeda_gsRecognize(Moeda.Id) as Recognize 
from 
  Moeda 
order by 
  Recognize 
