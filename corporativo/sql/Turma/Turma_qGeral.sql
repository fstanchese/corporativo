
select  
  id, 
  codigo, 
  nome, 
  turmati_id, 
  curso_id, 
  periodo_id, 
  duracxci_id,
  campus_id,
  turma_gsrecognize(id) as recognize 
from  
  turma  
order by
  recognize