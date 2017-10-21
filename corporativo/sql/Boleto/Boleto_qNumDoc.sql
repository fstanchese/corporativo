select
  Boleto.*,
  to_char(Boleto.Valor, '999G999D99')                 as ValorFormatado,
  to_char(Boleto.DtVencto, 'dd/mm/yyyy')              as VenctoFormatado,
  Trim(State_gsRecognize(Boleto_gnState(Boleto.id)))  as StateRecognize,
  Banco.Numero                                        as Banco,
  CCorrente.Agencia                                   as Agencia,
  CCorrente.Numero                                    as Conta,
  Trim(Wpessoa_gsRecognize(Boleto.WPessoa_Sacado_Id)) as WPessoaRecognize,
  To_Char(Boleto.NossoNum,'0000000000009')            as NossoNr, 
  Replace(to_char(Boleto.Valor,'9999D99'),',','.')    as valorLinhaCodigo
from
  Boleto,
  CCorrente,
  Banco
where
  Banco.Id (+) = Banco_Id
and
  CCorrente.Id (+) = CCorrente_Id
and
  NumDoc = nvl( p_Boleto_NumDoc , 0 )
