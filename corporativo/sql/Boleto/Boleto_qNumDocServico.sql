select
  nvl( max(NumDoc)+1 ,335700) as numdoc
from
  Boleto
where
  NumDoc >= 335700
and
  BoletoTi_Id in (92200000000004,92200000000005)