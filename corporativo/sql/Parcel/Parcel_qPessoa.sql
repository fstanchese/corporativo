select
  Parcel.*,
  to_char(Id  - 104400000000000,'0000000') || ' - ' || Dt as Recognize  
from
  Parcel
where
  (
    State_id = p_State_Id
  or
    p_State_Id is null
  )
and
  WPessoa_Id = nvl( p_WPessoa_Id , 0 )
order by
  Id