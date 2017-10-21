
select
  State.*
from
  State
where
  State.Id = nvl( p_State_Id ,0)


