select
  WOcorrAssReP.*,
  WOcorrAss_gsRecognize(WOcorrAss_Id) as WOcorrAss_Id_r
from
  WOcorrAssReP
where
  Id = nvl( p_WOcorrAssReP_Id ,0)