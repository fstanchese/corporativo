select
  WOcorr.Id                                             as Id,
  WOcorr.Dt                                             as Dt,
  nvl(Num,WOcorr_gnNumOcorrencia(WOcorr.Id))            as num,
  State_gsRecognize(WOcorr.State_Id)                    as SITUACAO,
  WOcorrAss_gsRecognize(WOcorrass_Id)                   as ASSUNTO,
  to_char(Solicitacao,'dd/mm/yyyy')                     as SOLICITACAO,
  WOcorrAss.Nomenet                                     as NomeNet,
  nvl(num,WOcorr_gnNumOcorrencia(WOcorr.Id)) || ' - ' || WOcorrAss.Nomenet || ' - ' || to_char(Solicitacao,'dd/mm/yyyy') as RECOGNIZE,
  decode(Recebimento.Valor,null,null,'R$' || trim(to_char(Recebimento.Valor,'999G999D99'))) as ValorPago,
  State_gsRecognize(Boleto_gnstate(Boleto.Id))          as BoletoSituacao,
  Recebimento.DtPagto                                   as DtPagto,
  WPessoa_gsRecognize(WOcorr.WPessoa_Id)                as Aluno,
  WPessoa_gnCodigo(WOcorr.WPessoa_Id)                   as Codigo,
  to_char(WOcorr.Dt,'DD/MM/YYYY HH24:MI:SS')            as DtHora,
  WOcorrAss.TempoResposta                               as Prazo,
  WOcorr.Us                                             as Usuario,
  WOcorr.State_Id                                       as State_Id,
  WOcorr.WOcorrAss_Id                                   as WOcorrAss_Id,
  WOcorr.SimNao_Defer_Id                                as SimNao_Defer_Id,
  WOcorr.RespEmail                                      as RespEmail
from 
  WOcorr,
  WOcorrAss,
  Boleto,
  Recebimento
where
  Boleto.Id = Recebimento.Boleto_Id (+)
and
  WOcorr.Boleto_Id = Boleto.Id (+)
and
  WOcorrAss.Disponibilizada is not null
and
  WOcorrAss.Id = WOcorr.WOcorrAss_Id
and
  WOcorr.Id =  p_WOcorr_Id 
