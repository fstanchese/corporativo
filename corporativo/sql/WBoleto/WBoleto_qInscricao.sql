select  
  Id  
from  
  WBoleto  
where
  Id = ( select min(id) from WBoleto where Ref = 'Vest 2006' and WPessoa_Sacado_Id is null )  
for update 