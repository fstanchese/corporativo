select
  semana.id,
  semana.numero as numero,
  semana.nome   as recognize
from
  semana
where
  numero > 1
order by
  numero
