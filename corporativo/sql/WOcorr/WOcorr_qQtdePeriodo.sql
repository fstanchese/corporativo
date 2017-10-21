select
  count(WOcorr.Id) as Qtde
from
  WOcorr
where
  (
    WOcorr.Campus_Id = p_Campus_Id 
  or
    p_Campus_Id is null
  )
and
  WOcorr.WOcorrAss_Id = p_WOcorrAss_Id 
and
  to_char(dt,'yyyymm') = p_WOcorr_AnoMes 

