select
  Count ( id )              as COUNT,
  nvl ( Sum ( Valor ) , 0 ) as VALORTOTAL  
from
  ParcelP
where
  ParcelP.Parcel_Id = nvl( p_Parcel_Id ,0 )
