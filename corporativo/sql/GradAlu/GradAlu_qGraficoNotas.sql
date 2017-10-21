select 
  count(*) as VALOR, 
  n2 as NOME
from
  gradalu
where 
  ( state_id != 3000000003002 and state_id != 3000000003003 and state_id != 3000000003009 )
and
  turmaofe_id = 7100000006150
group by n2
order by 2