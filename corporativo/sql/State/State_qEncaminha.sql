select
  State.*,
  State_gsrecognize(Id) as recognize
from
  State
where
 Id = 3000000026003 
order by recognize
