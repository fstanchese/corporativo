select
  State.*,
  State_gsrecognize(Id) as recognize
from
  State
where
  Id = 3000000002004
or 
  Id = 3000000002005
or
  Id = 3000000002008
or
  Id = 3000000002009
order by
  Id 
