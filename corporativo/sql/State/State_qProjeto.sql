select
  State.*,
  State_gsrecognize(Id) as recognize
from
  State
where
  Id = 3000000008001 
or 
  Id = 3000000008002 
or 
  Id = 3000000008003 
or 
  Id = 3000000008004
or 
  Id = 3000000008005 
order by
  Id 