select
  State.*,
  State_gsrecognize(Id) as recognize
from
  State
where
  Id like '30000000110%' 
order by
  Recognize 
