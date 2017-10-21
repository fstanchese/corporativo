select
  State.*,
  State_gsrecognize(Id) as recognize
from
  State
where
  Id in ( 3000000018001 , 3000000018002 , 3000000018003 )
order by
  recognize
