select
  Boleto.Id,
  Boleto.Valor,
  Boleto.DtVencto,
  Boleto.DtVencto || ' - R$' || trim(to_char(Boleto.Valor,'999G999D99')) as Recognize,
  Boleto.WPessoa_Sacado_Id,
  Boleto.Empresa_Sacado_Id 
from
  Boleto
where
  Dt > (sysdate - 60)
and
  BoletoTi_Id = 92200000000007
and
  (
    WPessoa_Sacado_Id = p_WPessoa_Id
  or
    Empresa_Sacado_Id = p_Empresa_Id
  )
order by
  4