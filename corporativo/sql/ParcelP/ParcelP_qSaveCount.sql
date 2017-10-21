select 
  count(parcelp.id) as qtd
from
  parcelp,
  parcel 
where
  parcelp.ltxt is null
and
  parcel.id=parcelp.parcel_id 
and
  parcel.state_id=3000000020003 
and
  to_date(parcel.dt) < to_date(sysdate)
