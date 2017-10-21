select
  Count( Id )                     as QTD,
  nvl ( Sum( VlrPrincipal ) , 0 ) as PRINCIPAL,
  nvl ( Sum( VlrMora ) , 0 )      as MORA,       
  nvl ( Sum( VlrMulta ) , 0 )     as MULTA,       
  nvl ( Sum( VlrTxFinanc ) , 0 )  as TXFINANC
from
  ParcelxBol
where
  Boleto_Orig_Id is not null
and
  Boleto_Dest_Id = nvl ( p_Boleto_Dest_Id , 0 )