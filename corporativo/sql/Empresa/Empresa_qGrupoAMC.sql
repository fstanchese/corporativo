select 
  Empresa.Id, 
  Empresa.Razao as Recognize  
from 
  Empresa 
where 
  Empresa.Id in ('42500000000422','42500000004707','42500000000592') 
order by 
  Recognize 
