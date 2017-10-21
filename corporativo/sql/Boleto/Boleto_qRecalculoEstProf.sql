select
  valor as valor,
  id as DebCred_Id
from
 debcred 
where 
 (
    debcred.boleto_destino_id is null 
  or 
    debcred.boleto_destino_id = p_Boleto_Id
 ) 
and
  debcred.matricestdir_or_id is not null 
and 
  state_id <> 3000000016003 
and
  Trunc(dtprevisao) = p_DebCred_DtPrevisao 
and
  wpessoa_id = nvl( p_WPessoa_Id , 0 )