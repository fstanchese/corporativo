select
  horaaula.id,
  horaaula.dtinicio,
  horaaula.dttermino,
  horaaula_troca_id
from
  horaaula
start with horaaula_troca_id = nvl( p_HoraAula_Id ,0)
  connect by horaaula_troca_id = prior horaaula.id
order by id desc