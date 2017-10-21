select
  id,
  nome as recognize 
from
  State
where
  id like '30000000120%'
order by
  recognize