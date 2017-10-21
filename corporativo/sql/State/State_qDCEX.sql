select
  State.*,
  State_gsrecognize(Id) as recognize
from
  State
where
  Id = 3000000036001 
or 
  Id = 3000000036002
or 
  Id = 3000000036003 
order by
  Id
