select
  WOcorrXAnexoTi.*,
  WOcorrXAnexoTi_gsRecognize(WOcorrXAnexoTi.Id) as Recognize,
  WOcorr.WPessoa_Id,
  to_char(WOcorr.Dt,'yyyymmdd')           as DtFormat,
  WPessoa_gsRecognize(WOcorr.WPessoa_Id)  as WPessoa_Id_r
from
  WOcorrXAnexoTi,
  WOcorr
where
  WOcorr.Id = WOcorrXAnexoTi.WOcorr_Id
and
  WOcorrXAnexoTi.Id = p_WOcorrXAnexoTi_Id
