select
  WOcorr.WOcorrAss_Id                         as WOcorrAss_Id,
  WOcorrAss_gsRecognize(WOcorr.WOcorrAss_Id)  as Assunto
from 
  WOcorr,
  WOcorrAss
where
  WOcorrAss.Nuprajur is null
and
  WOcorr.WOcorrAss_Id = WOcorrAss.Id
and
  (
    WOcorr.Campus_Id = p_Campus_Id
  or
    p_Campus_Id is null
  )
and
  trunc(WOcorr.Dt) between p_O_Data1 and p_O_Data2
group by
  WOcorr.WOcorrAss_Id
order by 2