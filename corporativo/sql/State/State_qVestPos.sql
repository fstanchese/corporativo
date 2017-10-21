select
  State.*,
  State_gsrecognize(Id) as recognize
from
  State
where
  Id = 3000000041004
or 
  Id = 3000000041003
or 
  Id = 3000000041002 
or 
  Id = 3000000041001 
order by
  Id 