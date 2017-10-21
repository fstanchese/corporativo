select
  WOcorrAssFlu.*,
  WOcorrAss.NomeNet                         as WOcorrAss_Recognize,
  WOcorrAssFlu_gsRecognize(WOcorrAssFlu.Id) as Recognize
from
  WOcorrAssFlu,
  WOcorrAss
where
  WOcorrAssFlu.WOcorrAss_Id = WOcorrAss.Id
order by
  WOcorrAss_Recognize,Recognize
