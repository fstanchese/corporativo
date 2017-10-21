select
  WOcorrAss_gsRecognize(WOcorr.WOcorrAss_Id)     as WOcorrAss_Recognize,
  count(WOcorr.Id)                               as Qtde,
  substr(WOcorr.Dt,7,4) || substr(WOcorr.Dt,4,2) as AnoMes
from
  WOcorrAssFlu,
  WOcorr
where
  WOcorr.WOcorrAss_Id = WOcorrAssFlu.WOcorrAss_Id
and
  WOcorrAssFlu.depart_id = p_Depart_Id
and
  trunc(WOcorr.Dt) between p_O_Data1 and p_O_Data2
group by wocorr.wocorrass_id, substr(wocorr.dt,7,4) || substr(wocorr.dt,4,2)
order by 1,3
