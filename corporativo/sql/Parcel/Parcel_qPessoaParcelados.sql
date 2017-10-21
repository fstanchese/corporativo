select
  Boleto.Valor                      as Valor,
  Boleto.Referencia                 as Referencia,
  to_char(valor,'999G990D99')       as valor,
  boletoti_gsrecognize(boletoti_id) as BOLETOTI_Recognize,
  to_char(dtvencto,'dd/mm/yyyy')    as dtvenctoformatado,
  to_char(Parcel.dt,'dd/mm/yyyy')   as dParcelformatado
from
  Parcel,
  ParcelBol,
  Boleto
where
  (
    (
      Boleto.Referencia like '%' || Trim( p_O_Boleto_Referencia ) || '%'
    and
      p_O_Boleto_Referencia is not null
    )
  or
    p_O_Boleto_Referencia is null
  )
and
  ParcelBol.Boleto_id = Boleto.Id
and
  ParcelBol.Parcel_Id = Parcel.Id
and
  to_Date( Parcel.dt ) between to_Date( p_O_Data1 ) and to_Date( p_O_Data2 )
and
  Parcel.WPessoa_Id = nvl( p_WPessoa_Id , 0 )
order by
  Parcel.Id