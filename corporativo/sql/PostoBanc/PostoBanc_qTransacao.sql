select
  Id
from
  postobanc 
where
  transacao like '%' || p_PostoBanc_Transacao || '%'
order by
  PostoBanc.Id