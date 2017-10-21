
select
  *
from
  sangue
where
  id = nvl( p_Sangue_Id ,0)
