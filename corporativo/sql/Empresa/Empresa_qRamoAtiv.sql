oDoc ( ) 

select 
  Empresa.*, 
  Lograd_gsRecognize(Lograd_Id)              as LOGRAD_ID_R, 
  to_char(Empresa.IE,'999G999G999G999G999')  as IE_F, 
  to_char(Empresa.CCM,'99G999G999')          as CCM_F, 
  to_char(substr(empresa.cgc,1,8),'99G999G999') || '/' || substr(empresa.cgc,9,4) || '-' || substr(empresa.cgc,13,2) as CGC_F, 
  RamoAtiv.Nome                              as RAMOATIV 
from
  Empresa, 
  RamoAtiv,
  EmpresaXRA 
where 
  EmpresaXRA.Empresa_Id = Empresa.Id 
and 
  EmpresaXRA.RamoAtiv_Id = RamoAtiv.Id 
and 
  ( RamoAtiv.Id in ( select Id from RamoAtiv start with Id = nvl( p_RamoAtiv_Id ,0 ) connect by RamoAtiv.RamoAtiv_Pai_Id = PRIOR RamoAtiv.Id ) 
    or 
    RamoAtiv.Id = nvl( p_RamoAtiv_Id ,0 ) 
    or 
    p_RamoAtiv_Id is null 
  ) 
order by 
  RamoAtiv.Nome, Empresa.Razao
