select
  WOcorrAssMsg.* 
from
  WOcorrAssMsg
where
  to_char(sysdate) between trunc(WOcorrAssMsg.DtInicio) and trunc(nvl(WOcorrAssMsg.DtTermino,sysdate))
and
  WOcorrAssMsg.WOcorrAss_Id = p_WOcorrAssMsg_WOcorrAss_Id 
order by
  DtInicio,Id 