select
  WOAXAnexoTi.*,
  AnexoTi_gsRecognize(AnexoTi_Id)                                 as AnexoTi_Recognize,
  WOcorrAss.NomeNet || ' - ' || AnexoTi_gsRecognize(AnexoTi_Id)   as Recognize
from
  WOAXAnexoTi,
  WOcorrAss
where
  WOAXAnexoTi.WOcorrAss_Id = WOcorrAss.Id
and
  WOAXAnexoTi.DocEntrega = 'on'
and
  WOAXAnexoTi.WOcorrAss_Id = nvl( p_WOcorrAss_Id , 0 )
order by
  AnexoTi_Recognize
