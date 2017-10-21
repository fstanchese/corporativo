select
  WOcorr.Id                                                                 as WOCORR_ID,
  WOcorr_gnNumOcorrencia(WOcorr.Id)                                         as Numero,
  WPessoa_gnCodigo(WOcorr.WPessoa_Id)                                       as RA,
  Campus_gsRecognize(WOcorr.Campus_Id)                                      as Campus,
  WOcorrAss.NomeNet                                                         as Assunto,
  shortname(WOcorrAss.NomeNet,45)                                           as Assunto_Abrev,
  State_gsRecognize(WOcorr.State_Id)                                        as Situacao,
  WOcorr.Dt                                                                 as Data,
  shortname(WPessoa_gsRecognize(WOcorr.WPessoa_Id),35)                      as Aluno,
  WOcorrFluxo.Dt                                                            as DtEncaminha,
  trunc(feriado_gdDiasUteis(trunc(WOcorr.Dt),WOcorrAss.TempoResposta))      as DtVencto,
  Depart_gsRecognize(WOcorrFluxo.Depart_Id)                                 as Depart_Recognize,
  WOcorrFluxo.Depart_Id                                                     as Depart_Id,
  WOcorr.WPessoa_Id                                                         as WPessoa_Id,
  WOcorrFluxo.USInicial                                                     as UsInicial,
  WOcorrFluxo.Id                                                            as WOcorrFluxo_Id
from
  WOcorr,
  WOcorrAss,
  WOcorrFluxo
where
  (
    WOcorr.Campus_Id = p_Campus_Id
  or
    p_Campus_Id is null
  )
and
  WOcorrAss.Nuprajur is null
and
  (
    WOcorrFluxo.Depart_Id = p_Depart_Id
  or
    p_Depart_Id is null
  )
and
  WOcorr.WOcorrAss_id = WOcorrAss.Id
and
  WOcorrFluxo.Id = (select max(id) from WOcorrFluxo where WOcorr_Id = WOcorr.Id)
and
  WOcorr.State_Id = 3000000011002
and
  (
    WOcorr.WOcorrAss_Id = p_WOcorrAss_Id
  or
    p_WOcorrAss_Id is null
  )
and
  trunc(WOcorr.Dt) between p_O_Data1 and p_O_Data2
order by 
Depart_Recognize,WOcorrAss.Nomenet,Aluno
