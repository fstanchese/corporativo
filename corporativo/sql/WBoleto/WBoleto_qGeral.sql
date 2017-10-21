
select
  *
from
  wboleto
where
  id = nvl( p_wboleto_id ,0) 