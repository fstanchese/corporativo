
select  
  Id, 
  Nome, 
  Periodo_gsRecognize(Id) as Recognize 
from  
  Periodo  
order by
  nome