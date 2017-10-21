select
  WOcorr.Id                                                                                as WOCORR_ID,
  WOcorr.Dt                                                                                as Dt,
  WOcorr_gnNumOcorrencia(WOcorr.Id)                                                        as Numero,
  WPessoa_gnCodigo(WOcorr.WPessoa_Id)                                                      as RA,
  Campus_gsRecognize(WOcorr.Campus_Id)                                                     as Campus,
  WOcorrAss.NomeNet                                                                        as Assunto,
  State_gsRecognize(WOcorr.State_Id)                                                       as Situacao,
  WOcorr.Dt                                                                                as Data,
  shortname(WPessoa_gsRecognize(WOcorr.WPessoa_Id),20)                                     as Aluno,
  WOcorrFluxo.Dt                                                                           as DtEncaminha,
  trunc(feriado_gdDiasUteis(trunc(nvl(WOcorrFluxo.Dt,WOcorr.Dt)),WOcorrAss.TempoResposta)) as DtVencto,
  Depart_gsRecognize(Destino.Depart_Id)                                                    as Depart_Recognize,
  Destino.Depart_Id                                                                        as Depart_Id,
  WOcorr.WPessoa_Id                                                                        as WPessoa_Id
from
  WOcorr,
  WOcorrAss,
  WOcorrFluxo,
  WOcorrFluxo Destino
where
  WOcorrAss.Nuprajur is null
and
  WOcorr.WOcorrAss_id = WOcorrAss.Id
and
  Destino.Dt = (select max(dt) from WOcorrFluxo where WOcorr_Id = WOcorr.Id)
and
  Destino.WOCORR_ID = Wocorr.id
and
  WOcorrFluxo.Dt = (select min(dt) from WOcorrFluxo where WOcorr_Id = WOcorr.Id)
and
  WOcorrFluxo.DtAnexo is not null
and
  WOcorrFluxo.WOcorr_Id = WOcorr.Id
and
  WOcorr.Id = p_WOcorr_Id 