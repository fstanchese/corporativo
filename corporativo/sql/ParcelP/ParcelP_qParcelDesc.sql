select
  parcelp.*
from
  ParcelP
where
  ParcelP.Parcel_Id = nvl( p_Parcel_Id ,0)
order by numero desc