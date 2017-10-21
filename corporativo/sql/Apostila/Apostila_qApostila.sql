select
  Apostila.* 
from
  Apostila
where
  Apostila.DiplProc_Id = nvl( p_DiplProc_Id ,0)