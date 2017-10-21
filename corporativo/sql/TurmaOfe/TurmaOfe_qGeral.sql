
select  
  id, 
  turma_gsrecognize(turma_id) as recognize 
from  
  turmaofe 
order by
  recognize