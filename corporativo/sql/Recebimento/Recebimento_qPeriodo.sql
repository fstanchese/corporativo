select
  to_char(Boleto_gnPrincipal(Boleto.Id),'999990D99')                           as ValorPrincipal,
  WPessoa.Id                                                                   as WPessoa_Id,
  O_gnCPF(WPessoa.CPF)                                                         as CPFValido,
  to_char(Recebimento.DtPagto,'yyyymmdd')                                      as DtPagtoFormatNFe,
  Boleto.Valor                                                                 as ValorBoleto,
  to_char(trunc(Boleto.Valor * 0.05,2),'0000000000000D09')                     as ValorISSBoletoNFe,
  to_char(trunc(trunc((Boleto.Valor * 0.05 ),2) * 0.3,2),'0000000000000D09')   as ValorCreditoBoletoNFe,
  to_char(Boleto_gnPrincipal(Boleto.Id),'0000000000000D09')                    as ValorPrincipalNFe,
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
  Boleto_gsDescritivo(Boleto.Id)                                               as DescritivoBoleto,
  to_char(Recebimento.Multa,'9990D99')                                         as MultaFormat,
  to_char(Recebimento.Mora,'9990D99')                                          as MoraFormat,
  to_char(Boleto.Valor,'99990D99')                                             as ValorBoletoFormat,
  to_char(Recebimento.Valor,'99990D99')                                        as ValorRecebFormat,
  Recebimento.Valor                                                            as ValorRecebido,
  to_char(Boleto.DtVencto,'dd/mm/yyyy')                                        as BoletoDtVencto,
  Recebimento.Id                                                               as Recebimento_Id,
  Recebimento.NFe                                                              as NFE,
  Recebimento.NFeRPS                                                           as NFERPS,
  Boleto_gnPrincipal(Boleto.Id)                                                as ValorPrincipalNum,
  Boleto.Valor - Recebimento.Valor                                             as DifPagamento,
  Boleto.Empresa_Sacado_Id                                                     as Empresa_Sacado_Id,
  Recebimento.*,
  Boleto.Competencia                                                           as Competencia
from
  Recebimento,
  Boleto,
  WPessoa,
  Lograd,
  Bairro,
  Cidade,
  Estado
where
  Cidade.Estado_Id = Estado.Id (+)
and
  Bairro.Cidade_Id = Cidade.Id (+)
and
  Lograd.Bairro_Id = Bairro.Id (+)
and
  WPessoa.Lograd_Id = Lograd.Id (+)
and
  Recebimento.NFeNaoEnviar is null
and
  Recebimento.Parcel_Origem_Id is null
and
  Recebimento.Boleto_Origem_Id is null
and
  (
    WPessoa.Id = p_WPessoa_Id
  or
    p_WPessoa_Id is null
  )
and
  WPessoa.Id = Boleto.WPessoa_Sacado_Id
and
  (
    Boleto.Campus_Id = nvl( p_Campus_Id , 0)
  or
    p_Campus_Id is null
  )
and
  (
    Boleto.BoletoTi_Id = nvl( p_BoletoTi_Id , 0 )
      or
    p_BoletoTi_Id is null
  )
and
  Boleto.Id = Recebimento.Boleto_Id
and
  Recebimento.DtPagto between to_date( p_O_Data1 ) and to_date( p_O_Data2 )
order by
  DtPagto
