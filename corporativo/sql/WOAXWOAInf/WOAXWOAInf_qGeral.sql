select
  WOAXWOAInf.*,
  WOAXWOAInf_gsRecognize(WOAXWOAInf.Id)   as Recognize,
  WOcorrass.NomeNet                       as NomeNet
from
  WOAXWOAInf,
  WOcorrass
where
  WOAXWOAInf.WOcorrass_Id = WOcorrass.Id
order by
  Recognize
