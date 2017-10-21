select
  WOAXAnexoTi.*,
  WOcorrAss_gsRecognize(WOcorrAss_Id) as WOcorrAss_Id_r,
  WOcorrAss.NomeNet,
  WOcorrAss_Id                        as WOcorrAss_Id
from
  WOAXAnexoTi,
  WOcorrAss
where
  WOAXAnexoTi.WOcorrAss_Id = WOcorrAss.Id
and
  WOAXAnexoTi.Id = p_WOAXAnexoTi_Id
