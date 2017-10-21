
select
  Carimbo.*,
  Carimbo_gsRecognize(Id) as Recognize
from
  Carimbo
order by Recognize