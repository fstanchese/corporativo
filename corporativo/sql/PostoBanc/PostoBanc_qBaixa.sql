select
  ID,
  substr(transacao,12,6)  as TIPO,
  substr(transacao,20,14) as BOLETO_ID,
  to_number_def(replace(replace(substr(transacao,1,10),'_',' '),'.',',')) as VALOR,
  boleto_gnmulta( to_number_def(substr(transacao,20,14)), postobanc.dtprocessamento ) as MULTA,
  boleto_gnmora ( to_number_def(substr(transacao,20,14)), postobanc.dtprocessamento ) as MORA,
  PostoBanc.DTPROCESSAMENTO
from
  PostoBanc
where
  dtprocessamento is null
and
  ip = nvl ( p_PostoBanc_IP , '0' )
