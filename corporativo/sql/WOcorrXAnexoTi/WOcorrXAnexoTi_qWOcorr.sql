select
  WOcorrXAnexoTi.*,
  AnexoTi_gsRecognize(AnexoTi_Id)                   as AnexoTi_Recognize,
  WOcorrXAnexoTi_gsRecognize(WOcorrXAnexoTi.Id)     as Recognize,
  Campus_gsRecognize(WOcorr.Campus_Id)              as Campus_Recognize,
  Depart_gsRecognize(WOcorrXAnexoTi.Depart_Resp_Id) as Depart_Recognize,
  WOcorr.Campus_Id                                  as WOcorr_Campus_Id
from
  WOcorrXAnexoTi,
  WOcorr
where
  WOcorrXAnexoTi.WOcorr_Id = WOcorr.Id
and
  WOcorrXAnexoTi.WOcorr_Id = nvl( p_WOcorr_Id , 0 )
order by
  AnexoTi_Recognize
