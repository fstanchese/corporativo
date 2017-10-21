select 
  id as SaaSenha_Id,
  numero 
from 
  saasenha 
where 
  saamesa_id is null
and 
  cancelada is null
and
  atendida is null
and 
  Campus_Id = nvl( p_Campus_Id ,0)
