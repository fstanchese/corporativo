select 
  count(distinct(substr(Boleto.OrdemRef,1,4))) as QtdeAno
from
  Boleto 
where
  Boleto.OrdemRef is not null
and
  Boleto.WPessoa_Sacado_Id = p_WPessoa_Id
