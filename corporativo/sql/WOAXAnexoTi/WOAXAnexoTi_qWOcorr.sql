select
  WOcorrXAnexoTi.*,
  AnexoTi_gsRecognize(Anexoti_id)              as Anexo,
  to_char(WOcorrXAnexoTi.DT,'DD/MM/YYYY HH24:MI') as Datahora,
  QtdeVias
from
  WOcorrXAnexoTi
where
  AnexoTi_Id not in 
  (
    select AnexoTi_Id from WOAXAnexoTi
    where WOcorrAss_Id = p_WOcorrAss_Id    
  )
and
  WOcorr_Id = p_WOcorr_Id
