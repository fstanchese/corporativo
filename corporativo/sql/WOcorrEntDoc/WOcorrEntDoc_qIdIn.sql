select
  WOcorrEntDoc.*,
  AnexoTi_gsRecognize(AnexoTi_Id)                               as AnexoTi_Recognize,
  WOcorrEntDoc.Dt || ' - ' || WOcorrEntDoc.US || ' - ' || AnexoTi_gsRecognize(AnexoTi_Id) as Recognize,
  WOcorr_gnNumocorrencia(WOcorr_Id)                             as Num_Ocorrencia,
  WOcorr.WOcorrAss_Id                                           as WOcorrAss_Id,
  WOcorr.SimNao_Defer_Id                                        as SimNao_Defer_Id,
  WOcorr_gsRetDeferimento(WOcorr.Id)                            as Deferimento
from
  WOcorrEntDoc,
  WOcorr
where
  WOcorr.Id = WOcorrEntDoc.WOcorr_Id
and
  dtentrega is not null 
and
  WOcorrEntDoc.WOcorr_Id in ( p_WOcorr_Id  )
order by
  Num_Ocorrencia, AnexoTi_Recognize