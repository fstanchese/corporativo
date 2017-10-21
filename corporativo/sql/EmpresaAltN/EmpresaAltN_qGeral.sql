select
  EmpresaAltN.*,
  EmpresaAltN_gsRecognize(EmpresaAltN.Id) as Recognize,
  empresa_gsrecognize(empresa_id) as empresa
from
  EmpresaAltN
order by Razao