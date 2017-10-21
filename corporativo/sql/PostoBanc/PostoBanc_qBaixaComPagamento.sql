select
  sum( to_number_def(replace(replace(substr(transacao,1,10),'_',' '),'.',',')) ) as VALOR_ZERO
from
  PostoBanc
where
  dtprocessamento is null
and
  ip = nvl ( p_PostoBanc_IP , '0' )
