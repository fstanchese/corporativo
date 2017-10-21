select
  to_char(Boleto.Valor,'999990D99')                                            as ValorPrincipal,
  WPessoa.Id                                                                   as WPessoa_Id,
  O_gnCPF(WPessoa.CPF)                                                         as CPFValido,
  to_char(Boleto.DtVencto,'yyyymmdd')                                          as DtPagtoFormatNFe,
  to_char(Boleto.Valor,'0000000000000D09')                                     as ValorBoleto,
  to_char(trunc(Boleto.Valor * 0.05,2),'0000000000000D09')                     as ValorISSBoletoNFe,
  to_char(trunc(trunc((Boleto.Valor * 0.05 ),2) * 0.3,2),'0000000000000D09')   as ValorCreditoBoletoNFe,
  to_char(Boleto.Valor,'0000000000000D09')                                     as ValorPrincipalNFe,
  nvl(to_char(WPessoa.CPF,'00000000000009'),'00000000000000')                  as CPFTomador,
  WPessoa.Nome                                                                 as NomeAluno,
  Boleto.Referencia                                                            as Referencia,
  Lograd.CEP                                                                   as CEP,
  shortname(Lograd.Nome,50)                                                    as Logradouro,
  shortname(WPessoa.EnderNum,10)                                               as EnderNum,
  shortname(Bairro.Nome,30)                                                    as Bairro,
  shortname(Cidade.Nome,50)                                                    as Cidade,
  Estado.Sigla                                                                 as UF,
  Lograd.CEP                                                                   as CEP,
  shortname(WPessoa.Email1,50)                                                 as Email1,
  Boleto.BoletoTi_Id                                                           as BoletoTi_Id,
  Boleto.NossoNum                                                              as NossoNum,
  BoletoTi_gsRecognize(BoletoTi_Id)                                            as BoletoTi_Recognize,
  Boleto_gsDescritivoComp(Boleto.Id)                                           as DescritivoBoleto,
  to_char(Boleto.Valor,'99990D99')                                             as ValorBoletoFormat,
  to_char(Boleto.DtVencto,'dd/mm/yyyy')                                        as BoletoDtVencto,
  Boleto_gnPrincipal(Boleto.Id)                                                as ValorPrincipalNum,
  Boleto.Empresa_Sacado_Id                                                     as Empresa_Sacado_Id,
  Boleto.Competencia                                                           as Competencia,
  Boleto.Id                                                                    as Boleto_Id
from
  Boleto,
  WPessoa,
  Lograd,
  Bairro,
  Cidade,
  Estado,
  Recebimento
where
  Cidade.Estado_Id = Estado.Id (+)
and
  Bairro.Cidade_Id = Cidade.Id (+)
and
  Lograd.Bairro_Id = Bairro.Id (+)
and
  WPessoa.Lograd_Id = Lograd.Id (+)
and
  Boleto.WPessoa_Sacado_Id = WPessoa.Id
and
  Boleto.Valor > 0
and
  (
    Empresa_Sacado_Id = p_Empresa_Sacado_Id
  or
    p_Empresa_Sacado_Id is null
  )
and
  (
    BoletoTi_Id = p_Boleto_BoletoTi_Id
  or
    p_Boleto_BoletoTi_Id is null
  )
and
  (
    Boleto.Campus_Id = p_Boleto_Campus_Id
  or
    p_Boleto_Campus_Id is null
  )
and
  Recebimento.Parcel_Origem_Id is null
and
  Recebimento.DtPagto between p_O_Data1 and p_O_Data2  
and
  Boleto.Id = Recebimento.Boleto_Id 
and
  Boleto.NFeRPS is null
and
  Boleto.State_Base_Id in (3000000000003,3000000000004,3000000000006,3000000000010)
and
  Boleto.Competencia = p_Boleto_Competencia 
and
  rownum < 3700