select
  State.*,
  State_gsrecognize(Id) as recognize
from
  State
where
  State.Id = 3000000003001
or 
  State.Id = 3000000003004
or 
  State.Id = 3000000003005
order by State.Id 
