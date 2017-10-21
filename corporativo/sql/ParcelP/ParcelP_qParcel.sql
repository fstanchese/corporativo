select
  parcelp.*,
  Boleto.DtVencto                                 as Boleto_DtVencto,
  to_char(Boleto.Valor,'999G999D99')              as Boleto_Valor,
  'R$'||trim(to_char(Boleto.Valor,'999G999D99'))  as Boleto_ValorFormat,
  Boleto.Referencia                               as Boleto_Referencia,
  Boleto.State_Base_Id                            as Boleto_State_Id,
  trim(to_char(ParcelP.Valor,'999999D99'))        as ParcelP_ValorFormat
from
  ParcelP,
  Boleto
where
  Boleto.Id (+) = ParcelP.Boleto_Id
and
  (
    ParcelP.Numero = p_O_Numero
  or
    p_O_Numero is null
  )
and
  ParcelP.Parcel_Id = nvl( p_Parcel_Id ,0)
order by numero