select
  Civil.*,
  Civil_gsRecognize(Id) as Recognize
from
  Civil
order by Recognize
