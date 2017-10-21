select
  Recebimento.DtPagto                       as DtPagto,
  Boleto.Referencia                         as Referencia,
  Boleto.NossoNum                           as NossoNum,
  to_char(Boleto.Valor,'999G999D99')        as Boleto_Valor,
  Boleto.DtVencto                           as Boleto_DtVencto,
  BoletoTi_gsRecognize(Boleto.BoletoTi_Id)  as BoletoTi_Recognize,
  to_char(Recebimento.Valor,'999G999D99')   as Recebimento_Valor,
  Recebimento_gsOrigem(Recebimento.Id,'on') as TpBaixa
from
  Boleto,
  Recebimento
where
  (
    Recebimento.PostoBanc_Origem_Id is not null
  or
    Recebimento.Cnab_Origem_Id is not null
  or
    BaixaMTi_Id is not null    
  )
and
  Boleto.Id = Recebimento.Boleto_Id
and
  Boleto.WPessoa_Sacado_Id = p_WPessoa_Id 
order by
  Recebimento.DtPagto desc