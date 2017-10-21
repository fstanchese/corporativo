select
  State.*,
  State_gsrecognize(Id) as recognize
from
  State
where
  Id in (3000000036001,3000000036002,3000000036003)
order by
  Recognize