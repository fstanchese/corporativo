select
  WOcorrAssTP.*,
  WOcorrAss.Nomenet as WocorrAss_Id_r
from
  WOcorrAssTP,
  WOcorrAss
where
  WOcorrAssTP.WOcorrAss_Id = WOcorrAss.Id
and
  WOcorrAssTP.Id = p_WOcorrAssTP_Id 
