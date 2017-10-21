select
  WOAXProtMsg.*,
  WOcorrAss.NomeNet                   as WOcorrAss_Id_r,
  WOcorrAss_Id                        as WOcorrAss_Id,
  ProtMsg_Id                          as ProtMsg_Id,
  ProtMsg_gsRecognize(ProtMsg_Id)     as ProtMsg_Id_r
from
  WOAXProtMsg,
  WOcorrass
where
  WOAXProtMsg.WOcorrass_Id = WOcorrass.Id
and
  WOAXProtMsg.Id = p_WOAXProtMsg_Id
