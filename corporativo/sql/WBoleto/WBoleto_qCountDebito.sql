select
  count(Id) as count 
from
  WBoleto
where
  substr(Ref,1,4) <> 'Vest'
and
  substr(Ref,1,4) <> 'Serv'
and
  trunc(DtVencto) < trunc(sysdate)
and
  State_Id = 3000000000002
and
  WPessoa_Sacado_Id = nvl ( p_WPessoa_Id ,0)
