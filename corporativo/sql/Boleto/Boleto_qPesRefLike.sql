select
  Boleto.* ,
  to_char(valor,'999G999D99') as valor_format,
  substr(Boleto.Competencia,5,2) || '/' || substr(Boleto.Competencia,1,4) as comp_format
from
  Boleto
where
  (
    BoletoTi_Id = nvl ( p_BoletoTi_Id , 0 )
  or
    p_BoletoTi_Id is null
  )
and
  Referencia like '%' || p_Boleto_Referencia || '%'
and
  WPessoa_Sacado_Id = nvl ( p_WPessoa_Id , 0 )
