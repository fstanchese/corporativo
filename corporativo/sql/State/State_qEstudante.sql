select
  State.Id,
  State.Nome as Recognize  
from
  State
where
  Id in ( 3000000002002,3000000002003 ) 
order by 2
