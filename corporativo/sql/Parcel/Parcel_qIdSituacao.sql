select
  Parcel.*,
  trunc(dt) as dt_trunc
from
  Parcel
where
  state_id = nvl( p_State_Id ,0)
and
  wpessoa_id = nvl( p_WPessoa_Id ,0)

