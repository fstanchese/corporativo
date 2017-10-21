select
  DiplProc.*
from
  DiplProc
where
  DiplProc.Id = nvl( p_DiplProc_Id , 0)