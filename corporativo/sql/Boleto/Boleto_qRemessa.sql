select
  trim(to_char(Boleto.Nossonum,'0000000000000'))                                 as NossoNum_Format,
  trim(to_char(Boleto.DtVencto,'DDMMYY'))                                        as DtVencto_Format,
  trim(to_char(Boleto.DtVencto,'DDMMYYYY'))                                      as DtVencto_Format2,
  trim(to_char(Boleto.Dt,'DDMMYY'))                                              as Dt_Format,
  trim(to_char(Boleto.Dt,'DDMMYYYY'))                                            as Dt_Format2,
  trim(replace(to_char(Boleto.Valor,'00000000000D00'),',',''))                   as Valor_Format,
  trim(to_char(Boleto.Valor,'999G999G999D00'))                                   as Valor_Formatado,
  Boleto.Valor                                                                   as Boleto_Valor,
  nvl(trim(substr(trim(replace(WPessoa_gsRetCPF(WPessoa.Id),'.','')),1,9)),'000000000')  as CPF_Format_P1,
  nvl(trim(substr(WPessoa_gsRetCPF(WPessoa.Id),14,2)),'00')                              as CPF_Format_P2,
  substr(trim(shortname(translate(upper(WPessoa.Nome),'¡√¬… Õ”‘⁄‹«','AAAEEIOOUUC'),40)),1,40) as Nome_Format,
  substr(trim(shortname(translate(upper(lograd_gsNome(nvl(WPessoa.Lograd_Entreg_Id,WPessoa.Lograd_Id))),'¡√¬… Õ”‘⁄‹«','AAAEEIOOUUC'),25)||','||nvl(endernumentreg,endernum)),1,40) as Lograd_Nome,
  substr(trim(shortname(translate(upper(lograd_gsBairro(nvl(WPessoa.Lograd_Entreg_Id,Wpessoa.Lograd_Id))),'¡√¬… Õ”‘⁄‹«','AAAEEIOOUUC'),12)),1,12) as Bairro_Nome,
  substr(trim(shortname(translate(upper(lograd_gsCidade(nvl(WPessoa.Lograd_Entreg_Id,Wpessoa.Lograd_Id))),'¡√¬… Õ”‘⁄‹«','AAAEEIOOUUC'),15)),1,15) as Cidade_Nome,
  trim(lograd_gsCEP(nvl(WPessoa.Lograd_Entreg_Id,Wpessoa.Lograd_Id)))            as Lograd_CEP,
  trim(lograd_gsEstadoSigla(nvl(WPessoa.Lograd_Entreg_Id,Wpessoa.Lograd_Id)))    as Estado_Sigla,
  trim(Boleto_gsPendente(WPessoa.Id,'on'))                                       as Debitos,
  trim(Boleto_gsPendente(WPessoa.Id,'on',100))                                   as Debitos2,
  nvl(BoletoItem_gsItem(Boleto.Id,166600000000025),'0,00')                       as Mensa,
  nvl(BoletoItem_gsItem(Boleto.Id,166600000000026),'0,00')                       as Licen,
  nvl(BoletoItem_gsItem(Boleto.Id,166600000000027),'0,00')                       as Outros,
  nvl(BoletoItem_gsItem(Boleto.Id,166600000000028),'0,00')                       as DInd,
  nvl(BoletoItem_gsItem(Boleto.Id,166600000000029),'0,00')                       as DP,
  nvl(BoletoItem_gsItem(Boleto.Id,166600000000030),'0,00')                       as Adap,
  trim(to_char(nvl(to_number(BoletoItem_gsItem(Boleto.Id,166600000000031)),0)+nvl(to_number(BoletoItem_gsItem(Boleto.Id,166600000000037)),0),'999G990D99'))                       as Estagio,
  nvl(BoletoItem_gsItem(Boleto.Id,166600000000032),'0,00')                       as Alfa,
  nvl(BoletoItem_gsItem(Boleto.Id,166600000000033),'0,00')                       as Bolsa,
  nvl(BoletoItem_gsItem(Boleto.Id,166600000000034),'0,00')                       as Desconto,
  nvl(BoletoItem_gsItem(Boleto.Id,166600000000035),'0,00')                       as Solidare,
  nvl(BoletoItem_gsItem(Boleto.Id,166600000000036),'0,00')                       as Mono,
  nvl(BoletoItem_gsItem(Boleto.Id,166600000000037),'0,00')                       as EstagioP,
  replace(upper(to_char(Boleto.Dtvencto,'DD')||' de '|| trim(to_char(Boleto.Dtvencto,'Month'))||' de '||to_char(Boleto.Dtvencto,'YYYY')||'.'),'«','C') as DataExtenso, 
  WPessoa.Codigo                                                                 as WPessoa_Codigo,
  substr(Boleto.OrdemRef,5,2)||'/'||substr(Boleto.OrdemRef,1,4)                  as OrdemRef,
  Empresa_gsCNPJFormatado(Boleto.Empresa_Cedente_Id)                             as CNPJ,
  trim(replace(to_char(Boleto.Valor*Inc.Multa,'00000000000D00'),',',''))         as Multa_Format,
  trim(replace(to_char(Boleto.Valor*Inc.Mora,'00000000000D00'),',',''))          as Mora_Format,
  'apos '||trim(Boleto.DtVencto)||' multa de R$'||trim(to_char((Boleto.Valor*Inc.Multa),'999G990D99'))||' + R$ '||trim(to_char((Boleto.Valor*Inc.Mora),'999G990D99'))||' ao dia'  as MsgMulta,
  SubStr(replace(mensagem.texto,'<BR>',''),001,69)                               as Msg01Remessa,
  SubStr(replace(mensagem.texto,'<BR>',''),070,69)                               as Msg02Remessa,
  SubStr(replace(mensagem.texto,'<BR>',''),139,69)                               as Msg03Remessa,
  SubStr(translate(upper(mensagem_gsRenovaMatri(Mensagem_Remessa_Id,Boleto.DtValidade)),'¡√¬… Õ”‘⁄‹«','AAAEEIOOUUC'),001,69)   as Msg01RenovaMatri,
  SubStr(translate(upper(mensagem_gsRenovaMatri(Mensagem_Remessa_Id,Boleto.DtValidade)),'¡√¬… Õ”‘⁄‹«','AAAEEIOOUUC'),070,69)   as Msg02RenovaMatri,
  SubStr(translate(upper(mensagem_gsRenovaMatri(Mensagem_Remessa_Id,Boleto.DtValidade)),'¡√¬… Õ”‘⁄‹«','AAAEEIOOUUC'),139,69)   as Msg03RenovaMatri,
  Mensagem_Remessa_Id                                                            as Mensagem_Remessa_Id
from
  Boleto,
  WPessoa,
  Inc,
  Mensagem
where
  Mensagem.id (+) = Boleto.Mensagem_Remessa_Id
and
  WPessoa.Lograd_Id is not null
and
  Boleto.Inc_Id = Inc.Id
and
  Boleto.WPessoa_Sacado_Id = WPessoa.Id
and
  Boleto.State_Base_Id = 3000000000006
and
  Boleto.Remessa_Id = p_Boleto_Remessa_Id