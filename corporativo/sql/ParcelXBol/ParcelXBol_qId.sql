select
  *
from
  ParcelXBol
where
  id = nvl ( p_ParcelXBol_Id , 0 )