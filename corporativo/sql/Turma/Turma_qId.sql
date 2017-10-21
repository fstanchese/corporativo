
select  
  id, 
  codigo, 
  nome, 
  turmati_id, 
  curso_id, 
  periodo_id, 
  duracxci_id,
  campus_id,
  turma_gsrecognize(id) as recognize, 
  duracxci_gsrecognize(duracxci_id) as duracxci_id_r,
  curso_gsrecognize(curso_id) as curso_id_r,
  codinep
from  
  turma  
where  
  id = nvl( p_Turma_Id ,0)
