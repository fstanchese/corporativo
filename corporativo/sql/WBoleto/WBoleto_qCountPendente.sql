select
  count(id) as count 
from
  WBoleto
where
  trunc(dtvencto) < trunc(sysdate)
and
  state_id = 3000000000002
and
  WPessoa_Sacado_Id = nvl ( p_WPessoa_Id ,0)
