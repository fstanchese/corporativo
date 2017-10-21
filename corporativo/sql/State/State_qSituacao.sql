select
  State.*,
  State_gsrecognize(Id) as recognize
from
  State
where
  Id = 3000000002002 
or 
  Id = 3000000002004 
or 
  Id = 3000000002005 
or 
  Id = 3000000002010 
or 
  Id = 3000000002011 
or 
  Id = 3000000002012 
order by
  Id 
