select
  recebimento.id as RECEBIMENTO_ID,
  recebimento.boleto_id as BOLETO_ID
from
  recebimento
where
  recebimento.postobanc_origem_id = nvl( p_PostoBanc_Id , 0)