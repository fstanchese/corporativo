
select
  FormaPag.*,
  FormaPag_gsRecognize(Id) as recognize
from
  FormaPag
order by
  recognize