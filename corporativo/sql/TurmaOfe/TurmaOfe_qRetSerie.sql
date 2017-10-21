oDoc ( Retorna a série a partir de um oferecimento de turma )

select  
  duracxci.id,
  duracxci.nomehtml,
  duracxci.sequencia as serie,
  duracxci_gsrecognize(duracxci.id) as serie_recognize
from  
  duracxci,
  turma,
  turmaofe
where  
  turma.duracxci_id = duracxci.id
and
  turmaofe.turma_id = turma.id
and
  turmaofe.id = nvl( p_TurmaOfe_Id ,0) 