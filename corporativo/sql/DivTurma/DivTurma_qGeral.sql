
select
  id,
  numero,
  nome as recognize 
from
  divTurma
where 
  numero <= p_DivTurma_Numero
order by
  numero
