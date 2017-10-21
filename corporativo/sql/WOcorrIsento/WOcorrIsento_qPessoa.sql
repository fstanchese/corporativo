select
  id 
from
  WocorrIsento
where
  PLetivo_Id = nvl( p_PLetivo_Id , 0)
and
  WPessoa_Id = nvl( p_WPessoa_Id , 0)
