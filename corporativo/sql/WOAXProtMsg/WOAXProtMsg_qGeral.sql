select
  WOAXProtMsg.*,
  WOAXProtMsg_gsRecognize(WOAXProtMsg.Id) as Recognize,
  WOcorrAss.NomeNet                       as NomeNet
from
  WOAXProtMsg,
  WOcorrAss
where
  WOAXProtMsg.WOcorrAss_Id = WOcorrAss.Id
order by
  Recognize
