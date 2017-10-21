
select 
  id, 
  nome,
  valor,
  abreviacao || ' - R$' || trim(to_char(valor,'999.99'))  as recognize 
from 
  wtxServico
order by 
  recognize
