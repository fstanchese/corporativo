select
  WOcorr.Id                                         as Id,
  WOcorr_gsRecognize(WOcorr.Id)                     as Recognize,
  WOcorrass_gsRecognize(WOcorrass.Id)               as WOcorrass_Id_r,
  WOcorrass.NomeNet                                 as NomeNet,
  WPessoa_gsRecognize(WOcorr.WPessoa_Id)            as WPessoa_Recognize,
  WPessoa_gnCodigo(WOcorr.WPessoa_Id)               as WPessoa_Codigo,
  to_char(WOcorr.Dt,'dd/mm/yyyy hh24:mi')           as datahora,
  nvl(WOcorr.Num,WOcorr_gnNumOcorrencia(WOcorr.Id)) as Num, 
  State_gsRecognize(state_id)                       as Situacao, 
  WOcorr_gnNumOcorrencia(WOcorr.Id)                 as Numero,
  WOcorrAss.TempoResposta                           as TempoResposta,
  WOcorr_gdVencimento(WOcorr.Id)                    as DtVencto,
  WOcorr.wpessoa_Id,
  WOcorr.solicitacao,
  WOcorr.wocorrass_id,
  WOcorr.state_id,
  WOcorr.wboleto_id,
  WOcorr.depart_id,
  WOcorr.saasenha_id,
  WOcorr.simnao_defer_id,
  WOcorr.boleto_id,
  WOcorr.Us,
  WOcorr.Dt,
  AHMat_gsRetIdProntuario(WOcorr.WPessoa_Id)        as ProntuarioAH,
  WOcorr.RespEmail,
  WOcorr.DtUrgencia
from
  WOcorr,
  WOcorrAss
where
  WOcorrAss.Id = WOcorr.WOcorrAss_Id
and
  WOcorr.Id = nvl( p_WOcorr_Id , 0)
