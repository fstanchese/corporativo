select
  Boleto.Id as Boleto_Id 
from
  Boleto,
  DebCred
where
  Boleto.Id = DebCred.Boleto_Destino_Id 
and
  DebCred.WOcorr_Origem_Id = p_WOcorr_Id 
