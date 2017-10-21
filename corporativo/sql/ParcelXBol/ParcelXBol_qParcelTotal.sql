select
  Count ( Parcel_Id )                                                 as QTD,
  nvl ( Sum ( VlrPrincipal ) , 0 )                                    as VALORPRINCIPAL,
  nvl ( Sum ( VlrMulta ) , 0 )                                        as VALORMULTA,
  nvl ( Sum ( VlrMora ) , 0 )                                         as VALORMORA,
  nvl ( Sum ( VlrTxFinanc ) , 0 )                                     as VALORTXFINANC,
  nvl ( Sum ( VlrPrincipal + VlrMulta + VlrMora + VlrTxFinanc ) , 0 ) as VALORTOTAL
from
  ParcelxBol
where
  Parcel_Id = nvl( p_Parcel_Id , 0 )
