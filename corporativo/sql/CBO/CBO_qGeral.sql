select
  CBO.Id,
  CBO_gsrecognize(id) as Recognize
from
  CBO
order by
  Recognize