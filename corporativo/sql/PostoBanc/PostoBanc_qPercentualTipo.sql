select
  to_number_def(replace(replace(substr(transacao,1,10),'_',' '),'.',',')) as VALORTITULO
from
  postobanc 
where
  substr(Transacao,12,6) not in ( 'pag_DN', 'pag_CH', 'pag_VD', 'pag_VC' )
and
  ip = p_PostoBanc_IP
and
  dtprocessamento = p_PostoBanc_DtProcessamento 