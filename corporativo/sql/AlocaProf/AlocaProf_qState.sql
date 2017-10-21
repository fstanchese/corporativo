select
  State.Id   as Id, 
  State.Nome as Recognize
from
  State
where
  State.id in ( 3000000037001,3000000037002 )
order by 1
