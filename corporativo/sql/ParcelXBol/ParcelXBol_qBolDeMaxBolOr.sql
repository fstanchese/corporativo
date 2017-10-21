select
  Max( Boleto_Orig_Id ) as Boleto_Id
from 
  ParcelXBol
where
  VlrPrincipal > nvl ( p_O_Valor , 0 )
and
  Boleto_Dest_Id = nvl ( p_Boleto_Dest_Id , 0 )