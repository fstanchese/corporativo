select
  Boleto.Referencia                           as REFERENCIA,
  Boleto.NossoNum                             as NOSSONUM,
  Boleto.Dtvencto                             as VENCTO,
  to_char(Boleto.valor, '999G999D99')         as VALOR,
  Campus_gsRecognize(Campus_Id)               as Campus_Recognize,
  Empresa_gsCNPJFormatado(Empresa_Cedente_Id) as CNPJ
from
  Boleto
where
  boleto_gnstate(boleto.id) = 3000000000003 
and
  WPessoa_Sacado_Id = nvl( p_WPessoa_Id ,0 )
