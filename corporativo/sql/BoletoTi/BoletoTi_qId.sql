select
  BoletoTi.*
from
  BoletoTi
where
  Id = nvl( p_BoletoTi_Id , 0 )