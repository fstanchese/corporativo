
select
  Cheque.*,
  Cheque_gsRecognize(id) as Recognize
from
  Cheque