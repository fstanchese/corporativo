select
  count(Boleto.Id) as Qtde
from
  Boleto
where
  NumDoc = nvl( p_Boleto_NumDoc , 0 )
