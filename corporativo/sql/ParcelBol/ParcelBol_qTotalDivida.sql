select
  Count ( Boleto.Id )                                                                                as QTD,
  Sum ( Boleto_gnValor(boleto.id , p_O_Data , Mora , Multa ) + DescontoMora + DescontoMulta )        as VALORTOTAL,
  Sum ( Decode( Multa , 'on', 0, Boleto_gnMulta(boleto.id , p_O_Data ) ) + DescontoMulta )           as VALORMULTA,
  Sum ( Decode( Mora , 'on', 0, Boleto_gnMora(boleto.id , p_O_Data ) ) + DescontoMora )              as VALORMORA,
  Sum ( Boleto.Valor  )                                                                              as VALORPRINCIPAL
from
  ParcelBol,
  Boleto
where
  Boleto.id = ParcelBol.Boleto_Id
and
  ParcelBol.Parcel_Id = nvl( p_Parcel_Id , 0 )