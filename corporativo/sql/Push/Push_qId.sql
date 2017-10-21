select
  Push.*, to_char(DtAcesso, 'dd/mm/yyyy hh24:mi') as DtAcessoFormat
from
  Push
where
  id = p_Push_Id
order by
   DtAcesso DESC
