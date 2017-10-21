select
  WOAXAnexoTi.*,
  WOcorrAss.NomeNet || ' - ' || AnexoTi_gsRecognize(AnexoTi_Id) as Recognize
from
  WOAXAnexoTi,
  WOcorrAss
where
  WOAXAnexoTi.WOcorrAss_Id = WOcorrAss.Id
and
  WOAXAnexoTi.DocEntrega = 'on'
order by
  Recognize