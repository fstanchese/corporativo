select
  Remessa.*,
  Nome as recognize
from
  Remessa
where
  dtEnvio is null
order by dt desc