select
  Id                     as POSTOBANC_ID,
  substr(Transacao,12,6) as TIPO
from
  postobanc 
where
  substr(Transacao,12,6) in ( 'pag_DN', 'pag_CH', 'pag_VD', 'pag_VC' )
and
  ip = p_PostoBanc_IP
and
  dtprocessamento = p_PostoBanc_DtProcessamento
order by
  PostoBanc.Id
