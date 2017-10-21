select
  Boleto.*,
  WPessoa_gsRecognize(Boleto.WPessoa_Sacado_Id) as WPessoa_Recognize,
  to_char(Boleto.Valor,'999G999D99')            as Valor_Format,
  to_char(Boleto.Valor,'999999D99')             as Valor_Decimal,
  CCorrente.Agencia                             as Agencia,
  CCorrente.Numero                              as CCorrente,
  to_char(Boleto.NossoNum,'0000000000009')      as NOSSONR,
  State_gsRecognize(Boleto_gnState(Boleto.Id))  as Situacao,
  Boleto_gnState(Boleto.Id)                     as State_Id,
  to_Char(Boleto.DtVencto, 'DD/MM/YYYY')        as DtVencto_Format,
  BoletoTi_gsRecognize(Boleto.BoletoTi_Id)      as BoletoTi,
  Boleto_gnBoletoTi(Boleto.Id)                  as BoletoTi_Origem
from
  Boleto,
  CCorrente
where
  Boleto.CCorrente_Id = CCorrente.Id
and
  Boleto.Id = nvl( p_Boleto_Id ,0)
