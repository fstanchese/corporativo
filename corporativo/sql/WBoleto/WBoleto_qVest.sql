select
  Id,
  DtVencto
from
  WBoleto
where
  Ref='Vest 2006'
and
  WPessoa_Sacado_Id = nvl( p_WPessoa_Id ,0) 

