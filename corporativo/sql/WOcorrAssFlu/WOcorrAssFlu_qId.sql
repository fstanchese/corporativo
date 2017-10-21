select
  WOcorrAssFlu.*,
  WOcorrAss_gsRecognize(WOcorrAss_Id) as WOcorrAss_Id_r
from
  WOcorrAssFlu
where
  Id = nvl( p_WOcorrAssFlu_Id ,0)