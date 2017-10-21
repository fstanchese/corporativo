select
  State.*,
  State_gsrecognize(Id) as recognize
from
  State
where
  Id = 3000000013001 
or 
  Id = 3000000013002 
order by
  Id 
