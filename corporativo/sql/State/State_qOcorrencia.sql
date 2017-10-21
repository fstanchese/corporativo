select
  State.*,
  State_gsrecognize(Id) as recognize
from
  State
where
  Id = 3000000011001 
or 
  Id = 3000000011002 
or 
  Id = 3000000011003 
or 
  Id = 3000000011004 
or 
  Id = 3000000011005
order by
  Id 
