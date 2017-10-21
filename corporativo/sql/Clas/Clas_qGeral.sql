select
  Class.*,
  Class_gsrecognize(Id) as recognize
from
  Class
order by id
