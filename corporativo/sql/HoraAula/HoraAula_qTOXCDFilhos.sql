select
  horaaula.id as ID,
  replace(replace(horaaula_gsrecognize(horaaula.id),'Noturno - ',''),'Matutino - ','') as recognize
from 
  horaaula 
start with id = nvl( p_HoraAula_Id ,0)
  connect by id = prior horaaula_troca_id
order by id desc
