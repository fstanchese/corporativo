select
  Boleto.Id                                                                            as BOLETO_ID,
  Trunc ( DtVencto )                                                                   as VENCIMENTO,
  Boleto_gnValor( boleto.id , p_O_Data , Mora , Multa ) + DescontoMora + DescontoMulta as TOTAL,
  Decode ( Multa, 'on', 0, Boleto_gnMulta( boleto.id , p_O_Data ) ) + DescontoMulta    as MULTA,
  Decode ( Mora, 'on', 0, Boleto_gnMora( boleto.id , p_O_Data ) ) + DescontoMora       as MORA,
  Boleto.Valor                                                                         as PRINCIPAL,
  Boleto.State_Base_Id                                                                 as Boleto_State_Id
from
  ParcelBol,
  Boleto
where
  Boleto.id = ParcelBol.Boleto_Id
and
  ParcelBol.Parcel_Id = nvl( p_Parcel_Id , 0 )
order by Trunc ( dtvencto )