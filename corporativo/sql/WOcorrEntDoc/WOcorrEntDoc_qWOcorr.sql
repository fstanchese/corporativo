select
  WOcorrEntDoc.*,
  AnexoTi_gsRecognize(AnexoTi_Id)            as AnexoTi_Recognize,
  WOcorrEntDoc_gsRecognize(WOcorrEntDoc.Id)  as Recognize
from
  WOcorrEntDoc
where
  WOcorrEntDoc.WOcorr_Id = nvl( p_WOcorr_Id , 0 )
order by
  AnexoTi_Recognize
