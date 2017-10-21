select 
  id as SaaSenha_Id,
  numero 
from 
  saasenha 
where 
  cancelada is null
and
  atendida is null
and
  saamesa_id = (
                select id from saamesa where ip='$ip' 
               )