select
  Boleto.Id                                         as Id,
  dtvencto                                          as dtVencto,
  Boleto.BoletoTi_Id                                as BoletoTi_Id
from
  Boleto
where
  trunc(dtvencto) <= trunc(sysdate)-5
and
  State_Base_Id = 3000000000006
and
  BoletoTi_Id in (92200000000002,92200000000003)
and
  WPessoa_Sacado_Id = nvl ( p_WPessoa_Id ,0)
order by dtvencto
