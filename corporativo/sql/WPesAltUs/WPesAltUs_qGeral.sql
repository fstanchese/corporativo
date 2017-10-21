select
  WPesAltUs.*,
  WPesAltUs_gsRecognize(id) as Recognize
from
  WPesAltUs
order by
  Recognize