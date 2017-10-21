select
  Id                       as ID,
  nvl ( VlrPrincipal , 0 ) as PRINCIPAL,
  nvl ( VlrMora , 0 )      as MORA,       
  nvl ( VlrMulta , 0 )     as MULTA,       
  nvl ( VlrTxFinanc , 0 )  as TXFINANC
from
  ParcelxBol
where
  Boleto_Orig_Id is null
and
  Boleto_Dest_Id = nvl ( p_Boleto_Dest_Id , 0 )