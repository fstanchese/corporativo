select
  * 
from
  Semana
where
  upper(Nome) = upper( p_Semana_Nome )
order by 1
