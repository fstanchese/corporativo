
select
  State.*,
  State_gsrecognize(Id) as recognize
from
  State
where
  Id = 3000000005004 
or 
  Id = 3000000005005 
or 
  Id = 3000000005006 
or 
  Id = 3000000005007 
or 
  Id = 3000000005008 
or 
  Id = 3000000005009  
order by
  Id desc

