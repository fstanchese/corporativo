select
  to_char(Boleto_gnPrincipal(Boleto.Id),'999999D99')  as ValorPrincipal,
  WPessoa.Id    as WPessoa_Id,
  O_gnCPF(WPessoa.CPF)   as CPFValido,
  to_char(Recebimento.DtPagto,'yyyymmdd')   as DtPagtoFormatNFe,
  Boleto.Valor    as ValorBoleto,
  to_char(trunc(Boleto.Valor * 0.05,2),'0000000000000D09') as ValorISSBoletoNFe,
  to_char(trunc(trunc((Boleto.Valor * 0.05 ),2) * 0.3,2),'0000000000000D09') as ValorCreditoBoletoNFe,
  to_char(Boleto_gnPrincipal(Boleto.Id),'0000000000000D09')  as ValorPrincipalNFe,
  nvl(to_char(WPessoa.CPF,'00000000000009'),'00000000000000') as CPFTomador,
  WPessoa.Nome    as NomeAluno,
  Boleto.Referencia   as Referencia,
  Lograd.CEP    as CEP,
  shortname(Lograd.Nome,50)   as Logradouro,
  shortname(WPessoa.EnderNum,10)   as EnderNum,
  shortname(Bairro.Nome,30)   as Bairro, 
  shortname(Cidade.Nome,50)   as Cidade,
  Estado.Sigla    as UF,
  Lograd.CEP    as CEP,
  shortname(WPessoa.Email1,50)   as Email1,
  Boleto.BoletoTi_Id    as BoletoTi_Id,
  Boleto.NossoNum    as NossoNum,
  BoletoTi_gsRecognize(BoletoTi_Id)   as BoletoTi_Recognize,
  Boleto_gsDescritivo(Boleto.Id)   as DescritivoBoleto,
  to_char(Recebimento.Multa,'9999D99')   as MultaFormat,
  to_char(Recebimento.Mora,'9999D99')  as MoraFormat,
  to_char(Boleto.Valor,'99999D99')  as ValorBoletoFormat,
  to_char(Recebimento.Valor,'99999D99')  as ValorRecebFormat,
  Recebimento.Valor   as ValorRecebido,
  to_char(Boleto.DtVencto,'dd/mm/yyyy')  as BoletoDtVencto,
  Recebimento.Id   as Recebimento_Id,
  Recebimento.NFe    as NFE,
  Recebimento.NFeRPS    as NFERPS,
  Boleto.Id as Boleto_Id,
  Recebimento.* 
from
  wpessoa,
  boleto,
  Lograd,
  Bairro,
  Cidade,
  Estado,
  temprv2008,
  recebimento
where
  cidade.estado_id = estado.id (+)
and
  bairro.cidade_id = cidade.id (+)
and
  lograd.bairro_id = bairro.id (+)
and
  wpessoa.Lograd_id = Lograd.Id (+)
and
  boleto.id = recebimento.boleto_id
and
  boleto.wpessoa_sacado_id = wpessoa.id
and
  temprv2008.boleto = boleto.nossonum
and
  tempRV2008.Campus_Id = p_Campus_Id 
and
  dtusado is null
order by  DtPagto



