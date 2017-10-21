select
  WBoleto.*,
  State_Id as STATE
from
  WBoleto
where
  Ref = p_WBoleto_Ref
and
  WPessoa_Sacado_Id = p_WPessoa_Id