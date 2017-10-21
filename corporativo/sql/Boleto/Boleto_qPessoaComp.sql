select
  Boleto.* ,
  to_char(valor,'999G999D99') as valor_format
from
  Boleto
where
  (
    BoletoTi_Id = nvl ( p_BoletoTi_Id , 0 )
  or
    p_BoletoTi_Id is null
  )
and
  Competencia = nvl ( p_Boleto_Competencia , 0 )
and
  WPessoa_Sacado_Id = nvl ( p_WPessoa_Id , 0 )
