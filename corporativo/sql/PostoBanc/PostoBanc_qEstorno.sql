select
  b.*,
  substr(b.transacao, 12, 6)             as tipo,
  substr(b.transacao,20,14)              as BOLETO_ID,
  '001' || to_char ( b.dt, 'DDMMYYYY' )  as dt_editada,
  b.Id                                   as PostoBanc_Id
from
  postobanc a,
  postobanc b
where
  a.ip = b.ip
and
  a.dtprocessamento=b.dtprocessamento
and
  to_date(a.dt) = to_date(sysdate-3)
and
  a.id = 86200000000000 + p_O_Id 