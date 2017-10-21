Select 
  sala.*,
  salati.nome as tipo_sala
from 
  sala,
  salati
where
  sala.salati_id = salati.id
order by sala.id
