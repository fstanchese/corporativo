(
select
  Empresa.*, 
  to_char(substr(empresa.cgc,1,8),'99G999G999') || '/' || substr(empresa.cgc,9,4) || '-' || substr(empresa.cgc,13,2) as CGC_F, 
  Empresa_gsrecognize(Id) as recognize,
  'off'                   as historico 
from 
  Empresa  
where 
  ( ( ( upper(Razao) like '%'||replace(upper( p_Empresa_Razao ),' ','%')||'%' ) 
      and 
      ( p_Empresa_Razao is not null ) 
    ) 
    or 
    ( ( upper(Fantasia) like '%'||replace(upper( p_Empresa_Fantasia ),' ','%')||'%' ) 
      and 
      ( p_Empresa_Fantasia is not null ) 
    ) 
    or 
    ( ( Empresa.CGC = p_Empresa_CGC ) 
      and 
      ( p_Empresa_CGC is not null ) 
    ) 
  ) 
)
union
(
select
  Empresa.*, 
  to_char(substr(empresa.cgc,1,8),'99G999G999') || '/' || substr(empresa.cgc,9,4) || '-' || substr(empresa.cgc,13,2) as CGC_F, 
  Empresa_gsrecognize(Empresa.Id) as recognize,
 'on'                             as historico 
from 
  Empresa,
  EmpresaAltN
where 
  Empresa.Id = EmpresaAltN.Empresa_Id
and
  ( ( ( upper(EmpresaAltN.Razao) like '%'||replace(upper( p_Empresa_Razao ),' ','%')||'%' ) 
      and 
      ( p_Empresa_Razao is not null ) 
    ) 
    or 
    ( ( upper(EmpresaAltN.Fantasia) like '%'||replace(upper( p_Empresa_Fantasia ),' ','%')||'%' ) 
      and 
      ( p_Empresa_Fantasia is not null ) 
    ) 
    or 
    ( ( Empresa.CGC = p_Empresa_CGC ) 
      and 
      ( p_Empresa_CGC is not null ) 
    ) 
  ) 
)
order by
  recognize