
select
  AnexoTi.* 
from
  AnexoTi
where
  AnexoTi.Id = nvl( p_AnexoTi_Id ,0)
