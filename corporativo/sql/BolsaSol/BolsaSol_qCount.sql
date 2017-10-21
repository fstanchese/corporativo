oDoc ( retorna o número de bolsas em determinado estado )

select
  count(id) as count,
  to_char(count(id),'999G999') as count_format
from
  BolsaSol
where
  State_Id = nvl(  p_State_Id ,0)
and
  PLetivo_Id = nvl( p_PLetivo_Id ,0)
