select
  WOAXWOAInf.*,
  WOAXWOAInf_gsRecognize(WOAXWOAInf.Id)                as Recognize,
  WOcorrass.NomeNet                                    as NomeNet,
  WOcorrAssInf_gsRecognize(WOAXWOAInf.WOcorrAssInf_Id) as WOcorrAssInf_Recognize
from
  WOAXWOAInf,
  WOcorrass
where
  WOAXWOAInf.WOcorrass_Id = WOcorrass.Id
and
  WOcorrAss.Id = p_WOcorrAss_Id 
order by
  Recognize
