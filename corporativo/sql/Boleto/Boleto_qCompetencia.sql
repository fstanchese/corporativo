select
  *
from
  Boleto
where
  Boleto.State_Id <> 3000000000001
and
  Boleto.BoletoTi_Id = 92200000000003
and
  Boleto.Competencia = nvl ( p_Boleto_Competencia , 0 )

