select
  Push.*, to_char(DtAcesso, 'dd/mm/yyyy hh24:mi') as DtAcessoFormat
from
  Push
where
  WPessoa_Id = p_WPessoa_Id
order by
   DtAcesso DESC