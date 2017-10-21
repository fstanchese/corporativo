select
  WOAXWOAInf.*,
  WOcorrAss.NomeNet                         as WOcorrAss_Id_r,
  WOcorrAss_Id                              as WOcorrAss_Id,
  WOcorrassInf_Id                           as WOcorrAssInf_Id,
  WOcorrassInf_gsRecognize(WOcorrassInf_Id) as WOcorrAssInf_Id_r
from
  WOAXWOAInf,
  WOcorrass
where
  WOAXWOAInf.WOcorrass_Id = WOcorrass.Id
and
  WOAXWOAInf.Id = p_WOAXWOAInf_Id
