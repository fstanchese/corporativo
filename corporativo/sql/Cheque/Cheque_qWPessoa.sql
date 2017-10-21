
select 
  count(Cheque.Id) as qtde
from
  Cheque
where 
  Cheque_gnEmAberto(Cheque.Id) = 1
and
  Cheque.WPessoa_Id  = nvl( p_WPessoa_Id ,0)
