select
  Id,
  WOcorrAss_gsRecognize(WOcorrAss_Id) || ' - ' || DtInicio || ' - ' || DtTermino || ' - ' || substr(Texto,1,20) || '...' as Recognize,
  Texto
from
  WOcorrAssMsg
where
  WOcorrAss_Id = p_WOcorrAssMsg_WOcorrAss_Id
order by
  2
