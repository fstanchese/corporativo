
select
  Empresa.*,
  Lograd_gsRecognize(Lograd_Id)              as LOGRAD_ID_R,
  Empresa_gsRecognize(Id)                    as EMPRESA_ID_R,
  to_char(Empresa.IE,'999G999G999G999G999')  as IE_F,
  to_char(Empresa.CCM,'99G999G999')          as CCM_F,
  to_char(substr(empresa.cgc,1,8),'00G000G000') || '/' || substr(empresa.cgc,9,4) || '-' || substr(empresa.cgc,13,2) as CGC_F 
from
  Empresa
where
  Id = nvl( p_Empresa_Id ,0)
