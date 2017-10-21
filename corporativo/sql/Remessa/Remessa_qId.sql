select
  *
from
  Remessa
where
  id = nvl ( p_Remessa_Id , 0 )