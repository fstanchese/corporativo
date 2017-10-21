select
  WOcorrAssTP.*,
  WOcorrAss.Nomenet,
  WOcorrAssTP_gsRecognize(WOcorrAssTP.Id) as Recognize
from
  WOcorrAssTP,
  WOcorrAss
where
  WOcorrAssTP.WOcorrAss_Id = WOcorrAss.Id
and
  WOcorrAssTP.WOcorrAss_Id = p_WOcorrAss_Id 
order by
  WOcorrAssTP.Referencia
