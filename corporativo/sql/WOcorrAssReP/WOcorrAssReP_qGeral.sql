select
  WOcorrAssReP.*,
  WOcorrAssReP_gsRecognize(id) as Recognize
from
  WOcorrAssReP
order by
  Recognize