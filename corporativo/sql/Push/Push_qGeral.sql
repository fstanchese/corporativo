select
  Push.*, to_char(DtAcesso, 'dd/mm/yyyy hh24:mi') as DtAcessoFormat
from
  Push
 order by
   DtAcesso DESC