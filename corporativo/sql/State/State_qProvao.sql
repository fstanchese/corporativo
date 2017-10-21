select
  State.*,
  State_gsrecognize(Id) as recognize
from
  State
where
  Id = 3000000019001 
or 
  Id = 3000000019002 
or 
  Id = 3000000019003 
or 
  Id = 3000000019004 
or 
  Id = 3000000019005
order by
  Id 
