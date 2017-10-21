select
  CESJRepasse.Id                as Id,
  CESJRepasse.Valor             as Valor,
  trunc(CESJRepasse.VlrJuros,2) as Juros
from
  ParcelBol,
  CESJRepasse
where
  ParcelBol.CESJRepasse_Id = CESJRepasse.Id
and
  ParcelBol.Parcel_Id = p_Parcel_Id
order by
  Data