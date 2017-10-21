select
  ref 
from
  WBoleto
where
  trunc(dtvencto) < trunc(sysdate)
and
  state_id = 3000000000002
and
  substr(REF,1,4) not in 'Vest'
and
  substr(REF,1,4) not in 'Serv'
and
  WPessoa_Sacado_Id = nvl ( p_WPessoa_Id ,0)
order by ref
