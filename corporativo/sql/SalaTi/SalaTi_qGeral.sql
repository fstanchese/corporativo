select
  SalaTi.*,
  SalaTi_gsRecognize(Id) as Recognize
from
  SalaTi
order by
  Recognize