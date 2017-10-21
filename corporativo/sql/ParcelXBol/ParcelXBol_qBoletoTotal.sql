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
  Boleto_Orig_Id = nvl ( p_Boleto_Orig_Id , 0 )
or
  Boleto_Dest_Id = nvl ( p_Boleto_Dest_Id , 0 )
