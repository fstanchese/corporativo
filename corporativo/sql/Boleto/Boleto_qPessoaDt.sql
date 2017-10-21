select
  Boleto.Referencia                         as Referencia,
  Boleto.NossoNum                           as NossoNum,
  to_char(Boleto.Valor,'999G999D99')        as Boleto_Valor,
  Boleto.DtVencto                           as Boleto_DtVencto,
  BoletoTi_gsRecognize(Boleto.BoletoTi_Id)  as BoletoTi_Recognize,
  Boleto.Us                                 as Us
from
  Boleto
where
  (
    Boleto.BoletoTi_Id = p_Boleto_BoletoTi_Id
  or
    p_Boleto_BoletoTi_Id is null    
  )
and
  (
    upper(Boleto.Us) = p_Boleto_Us
  or
    p_Boleto_Us is null
  )
and
  trunc(Boleto.Dt) = p_O_Data
and
  Boleto.WPessoa_Sacado_Id = p_WPessoa_Id 
order by
  Boleto.Dt