select
  WOcorrAssMsg.*,
  WOcorrAss_gsRecognize(WOcorrAssMsg.WOcorrAss_Id) as WOcorrAss_Id_r
from
  WOcorrAssMsg
where
  WOcorrAssMsg.Id = p_WOcorrAssMsg_Id 
