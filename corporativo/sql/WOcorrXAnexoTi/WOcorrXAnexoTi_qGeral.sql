select
  WOcorrXAnexoTi.*,
  WOcorrXAnexoTi_gsRecognize(WOcorrXAnexoTi.Id) as Recognize
from
  WOcorrXAnexoTi
order by
  Recognize

