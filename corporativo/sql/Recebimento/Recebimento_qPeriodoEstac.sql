select
  Recebimento.*,
  to_char(Recebimento.DtPagto,'yyyymmdd')                                      as DtPagtoFormatNFe,
  Boleto.Valor                                                                 as ValorBoleto,
  to_char(trunc(Boleto.Valor * 0.05,2),'0000000000000D09')                     as ValorISSBoletoNFe,
  to_char(trunc(trunc((Boleto.Valor * 0.05 ),2) * 0.3,2),'0000000000000D09')   as ValorCreditoBoletoNFe,
  to_char(Boleto_gnPrincipal(Boleto.Id),'999999D99')                           as ValorPrincipal,
  to_char(Boleto_gnPrincipal(Boleto.Id),'0000000000000D09')                    as ValorPrincipalNFe,
  nvl(to_char(WPessoa.CPF,'00000000000009'),'00000000000000')                  as CPFTomador,
  nvl(to_char(Empresa_gnRetCNPJ(Boleto.Empresa_Sacado_Id),'00000000000009'),'00000000000000')    as CNPJTomador,
  WPessoa.Nome                                                                 as NomeAluno,
  Empresa.Razao                                                                as NomeEmpresa,
  Boleto.Referencia                                                            as Referencia,
  shortname(LogradWP.Nome,50)                                                  as Logradouro,
  shortname(WPessoa.EnderNum,10)                                               as EnderNum,
  shortname(BairroWP.Nome,30)                                                  as Bairro,
  shortname(CidadeWP.Nome,50)                                                  as Cidade,
  EstadoWP.Sigla                                                               as UF,
  LogradWP.CEP                                                                 as CEP,
  shortname(LogradE.Nome,50)                                                   as Logradouro_E,
  shortname(Empresa.EnderNum,10)                                               as EnderNum_E,
  shortname(BairroE.Nome,30)                                                   as Bairro_E,
  shortname(CidadeE.Nome,50)                                                   as Cidade_E,
  EstadoE.Sigla                                                                as UF_E,
  LogradE.CEP                                                                  as CEP_E,
  shortname(WPessoa.Email1,50)                                                 as Email1,
  Boleto.BoletoTi_Id                                                           as BoletoTi_Id,
  Boleto.NossoNum                                                              as NossoNum,
  BoletoTi_gsRecognize(BoletoTi_Id)                                            as BoletoTi_Recognize,
  Boleto_gsDescritivo(Boleto.Id)                                               as DescritivoBoleto,
  to_char(Recebimento.Multa,'9999D99')                                         as MultaFormat,
  to_char(Recebimento.Mora,'9999D99')                                          as MoraFormat,
  to_char(Boleto.Valor,'99999D99')                                             as ValorBoletoFormat,
  to_char(Recebimento.Valor,'99999D99')                                        as ValorRecebFormat,
  Recebimento.Valor                                                            as ValorRecebido,
  to_char(Boleto.DtVencto,'dd/mm/yyyy')                                        as BoletoDtVencto,
  Recebimento.Id                                                               as Recebimento_Id,
  Recebimento.NFe                                                              as NFE,
  Recebimento.NFeRPS                                                           as NFERPS,
  WPessoa.Id                                                                   as WPessoa_Id,
  O_gnCPF(WPessoa.CPF)                                                         as CPFValido,
  null                                                                         as NomeEmpresa
from
  Recebimento,
  Boleto,
  DebCred,
  VeicXEstac,
  Veiculo,
  Empresa,
  WPessoa,
  Lograd LogradWP,
  Bairro BairroWP,
  Cidade CidadeWP,
  Estado EstadoWP,
  Lograd LogradE,
  Bairro BairroE,
  Cidade CidadeE,
  Estado EstadoE
where
  CidadeE.Estado_Id = EstadoE.Id (+)
and
  BairroE.Cidade_Id = CidadeE.Id (+)
and
  LogradE.Bairro_Id = BairroE.Id (+)
and
  Empresa.Lograd_Id = LogradE.Id (+)
and
  CidadeWP.Estado_Id = EstadoWP.Id (+)
and
  BairroWP.Cidade_Id = CidadeWP.Id (+)
and
  LogradWP.Bairro_Id = BairroWP.Id (+)
and
  WPessoa.Lograd_Id = LogradWP.Id (+)
and
  (
    Boleto.Campus_Id = p_Campus_Id
  or
    p_Campus_Id is null
  )
and
  Veiculo.Empresa_Id = Empresa.Id(+)
and
  VeicXEstac.Veiculo_Id = Veiculo.Id
and
  DebCred.VeicXEstac_Origem_Id = VeicXEstac.Id
and
  Boleto.Id = DebCred.Boleto_Destino_Id
and
  trunc(Recebimento.DtPagto) between p_O_Data1 and p_O_Data2
and 
  WPessoa.Id = Boleto.WPessoa_Sacado_Id
and
  Boleto.Id=Recebimento.Boleto_Id 
and
  Boleto.BoletoTi_Id = 92200000000007
order by
  DtPagtoFormatNFe
