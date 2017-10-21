select
  distinct( Boleto.Id )                               as ID,
  Boleto.Wpessoa_Sacado_Id                            as WPessoa_Sacado_Id,
  Boleto.NossoNum                                     as NossoNum,
  Boleto.NumDoc                                       as NumDoc,
  Boleto.Valor                                        as Valor,
  to_char(Boleto.Valor, '9990D00')                    as ValorFormatado,
  to_char(Boleto.DtVencto, 'dd/mm/yyyy')              as VenctoFormatado,
  Trim(State_gsRecognize(Boleto_gnState(Boleto.id)))  as StateRecognize,
  Banco.Numero                                        as Banco,
  CCorrente.Agencia                                   as Agencia,
  CCorrente.Numero                                    as ContaCorrente,
  Trim(Wpessoa_gsRecognize(Boleto.WPessoa_Sacado_Id)) as WPessoaRecognize,
  To_Char(Boleto.NossoNum,'0000000000009')            as NossoNr, 
  Replace(to_char(Boleto.Valor,'9999D99'),',','.')    as ValorLinhaCodigo
from
  Boleto,
  CCorrente,
  Banco
where
  Banco.Id (+) = Banco_Id
and
  CCorrente.Id (+) = CCorrente_Id
and
  (
    NumDocAntigo =  nvl( '$p_Boleto_NumDocAntigo' , 0 )
  or
    NumDoc = nvl( '$p_Boleto_NumDoc' , 0 )
  or
    NossoNum =  nvl( '$p_Boleto_NossoNum' , 0 )
  )