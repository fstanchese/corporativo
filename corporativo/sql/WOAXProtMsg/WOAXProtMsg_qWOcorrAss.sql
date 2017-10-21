select
  WOAXProtMsg.*,
  WOAXProtMsg_gsRecognize(WOAXProtMsg.Id) as Recognize,
  ProtMsg.Protocolo as ProtMsg_Recognize 
from
  WOAXProtMsg,
  ProtMsg
where
  WOAXProtMsg.ProtMsg_Id = ProtMsg.Id
and
  WOAXProtMsg.WOcorrAss_Id = p_WOcorrAss_Id
order by
  Sequencia