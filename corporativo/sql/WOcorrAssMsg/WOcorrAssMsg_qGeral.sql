select
  	WOcorrAssMsg.*,
  	WOcorrAss_gsRecognize(WOcorrAssMsg.WOcorrAss_Id) as WOcorrAss_Id_r
from
  	WOcorrAssMsg
 order by
 	WOcorrAss_Id_r,DtInicio,DtTermino 
