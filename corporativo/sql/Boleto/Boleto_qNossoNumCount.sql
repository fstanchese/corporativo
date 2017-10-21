select
  count(Boleto.Id) as qtde
from
  Boleto
where
  NossoNum = nvl( p_Boleto_NossoNum , 0 )