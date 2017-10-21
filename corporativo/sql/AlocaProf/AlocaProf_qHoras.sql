select 
  horario_id as horario_id 
from 
  horaaula 
where 
  '31/12/2013' between horaaula.dtinicio and horaaula.dttermino 
and 
  horaaula.toxcd_id = p_TOXCD_Id
and
  horaaula.wpessoa_prof1_id = p_WPessoa_Id
order by horario_id
