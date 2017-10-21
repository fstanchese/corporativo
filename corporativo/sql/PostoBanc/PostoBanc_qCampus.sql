select
  Boleto.Campus_Id as CAMPUS,
  PostoBanc.Id     as POSTOBANC_ID
from
  boleto,
  recebimento, 
  postobanc 
where
  boleto.id = recebimento.boleto_id
and
  recebimento.postobanc_origem_id = postobanc.id
and 
  postobanc.id <> p_PostoBanc_Id
and
  ip = p_PostoBanc_IP
and
  dtprocessamento = p_PostoBanc_DtProcessamento
order by
  PostoBanc.Id
