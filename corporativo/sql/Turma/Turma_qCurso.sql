
select  
  id, 
  codigo, 
  nome, 
  turmati_id, 
  curso_id, 
  periodo_id, 
  nvl(to_char(duracxci_id),'''''')  as duracxci_id,
  campus_id,
  turma_gsrecognize(id)             as recognize, 
  duracxci_gsrecognize(duracxci_id) as serie
from  
  turma
where
  curso_id = nvl( p_Curso_Id ,0)
order by
  recognize