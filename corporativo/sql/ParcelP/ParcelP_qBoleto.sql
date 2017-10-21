select
  parcelp.*
from
  ParcelP
where
  ParcelP.Boleto_Id = nvl( p_Boleto_Id ,0)
order by numero