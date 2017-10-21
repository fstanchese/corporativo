select
  Boleto.*,
  substr(Boleto.Referencia,-7)                     as Parcela,
  to_char(Boleto.Valor,'999G999D99')               as Valor_Format,
  CCorrente.Agencia                                as Agencia,
  CCorrente.Numero                                 as CCorrente,
  to_char(Boleto.NossoNum,'0000000000009')         as NOSSONR,
  replace(to_char(BOLETO.VALOR,'9990D00'),'.',',') as valorFormatado,
  replace(to_char(BOLETO.VALOR,'9999D99'),',','.') as valorLinhaCodigo,
  EspecieDoc.Nome                                  as EspecieDoc,
  Aceite.Nome                                      as Aceite,
  Carteira.Nome                                    as Carteira,
  Instrucao_gsRecognize(Instrucao_LocPag_Id)       as LocalPagamento,
  Instrucao_gsRecognize(Instrucao_Comp_Id,Boleto.DtVencto,replace(to_char(trunc(Boleto.Valor*Inc.Multa,2),'9999D99'),'.',','),replace(to_char(trunc(Boleto.Valor*Inc.Mora,2),'9990D99'),'.',','))         as Inst_Compensacao,
  instrucao_gsRecognize(Boleto.Instrucao_LocPag_Id,Boleto.DtValidade)  as Instrucoes, 
  Empresa.Razao                                    as Empresa_Cedente,
  Empresa.CGC                                      as Empresa_CNPJ,
  Moeda.Moeda                                      as Moeda
from
  Boleto,
  CCorrente,
  EspecieDoc,
  Aceite,
  Carteira,
  Moeda,
  Empresa,
  Inc
where
  Inc.Id = Boleto.Inc_Id
and
  Empresa.Id = Boleto.Empresa_Cedente_Id
and
  Moeda.Id = Boleto.Moeda_Id
and
  Carteira.Id = Boleto.Carteira_Id
and
  Aceite.Id = Boleto.Aceite_Id
and
  EspecieDoc.Id = Boleto.EspecieDoc_Id
and
  CCorrente.Id = Boleto.CCorrente_Id 
and
  Boleto.Id = nvl( p_Boleto_Id ,0)