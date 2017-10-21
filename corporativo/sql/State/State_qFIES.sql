select
  State.*,
  State_gsrecognize(Id) as recognize
from
  State
where
  Id in (3000000031001,3000000031002,3000000031003,3000000031004,3000000031005,3000000031006,3000000031007)
order by
  Recognize
