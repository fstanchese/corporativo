select
  State.*,
  State_gsrecognize(Id) as recognize
from
  State
where
  Id = 3000000040003
or
  Id = 3000000040002 
or 
  Id = 3000000040001 
order by
  Id