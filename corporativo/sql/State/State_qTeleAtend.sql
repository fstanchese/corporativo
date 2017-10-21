select
  State.*,
  State_gsrecognize(Id) as recognize
from
  State
where
  Id = 3000000010001 
or 
  Id = 3000000010003 
order by
  Id 