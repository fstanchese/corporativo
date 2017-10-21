select
  id,
  nome as recognize 
from
  State
where
  id like '30000000000%'
order by
  recognize