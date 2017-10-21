select
  EmpresaAltN.*,
  EmpresaAltN_gsRecognize(EmpresaAltN.Id) as Recognize,
  empresa_gsrecognize(empresa_id) as empresa
from
  EmpresaAltN
where
  EmpresaAltN.Id = p_EmpresaAltN_Id 