oDoc ( Retorna o nível da graduação a partir de um oferecimento de turma )

select  
  curso.cursonivel_id,
  cursonivel_gsrecognize(curso.cursonivel_id) as recognize
from  
  curso,
  curr,
  currofe,
  turmaofe
where  
  curr.curso_id = curso.id
and
  currofe.curr_id = curr.id
and
  currofe.id = turmaofe.currofe_id
and
  turmaofe.id = nvl( p_TurmaOfe_Id ,0) 
