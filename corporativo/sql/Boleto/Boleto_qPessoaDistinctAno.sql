select 
  distinct(substr(Boleto.OrdemRef,1,4)) as Ano
from
  Boleto 
where
  Boleto.OrdemRef is not null
and
  Boleto.WPessoa_Sacado_Id = p_WPessoa_Id
order by Ano desc 