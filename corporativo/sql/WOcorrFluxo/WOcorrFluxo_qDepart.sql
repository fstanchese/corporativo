select
  WOcorr.Id                                                              as WOCORR_ID,
  WOcorr_gnNumOcorrencia(WOcorr.Id)                                      as Numero,
  Campus_gsRecognize(WOcorr.Campus_Id)                                   as Campus,
  WPessoa_gnCodigo(WOcorr.WPessoa_Id)                                    as RA,
  WOcorrAss.NomeNet                                                      as Assunto,
  State_gsRecognize(WOcorr.State_Id)                                     as Situacao,
  WOcorr.Dt                                                              as Data,
  shortname(WPessoa_gsRecognize(WOcorr.WPessoa_Id),20)                   as Aluno,
  WOcorrFluxo.DtAnexo                                                    as DtAnexo,
  WOcorrFluxo.Dt                                                         as DtEncaminha,
  to_char(WOcorrFluxo.Dt,'dd/mm')                                        as DtEncaminha_Formatado,
  WOcorrFluxo.UsInicial                                                  as UsInicial,
  WOcorr_gdVencimento(WOcorr.Id)                                         as Vencimento,
  substr(WOcorr_gdVencimento(WOcorr.Id),0,5)                             as Vencimento_Formatado,
  to_char(WOcorr.dt,'dd/mm/yyyy hh24:mi')                                as DataFormat,
  to_char(WOcorr.dt,'dd/mm hh24:mi')                                     as DataFormat_SemAno,
  WOcorrAss.TempoResposta                                                as Prazo,
  WOcorr.Us                                                              as Usuario,
  WOcorr.RespEmail                                                       as RespEmail,
  trunc(sysdate)-trunc(WOcorrFluxo.Dt)                                   as QtdeDiasAnexo,
  WOcorrFluxo.Id                                                         as WOcorrFluxo_Id,
  turma_gsRecognize(matric_gnretturma(WOcorr_gsRetMatricula(WOcorr.Id))) as Turma
from 
  WOcorr, 
  WOcorrAss,
  WOcorrFluxo
where
  (
    WOcorrAss.Nuprajur is null
  or
    (WOcorrAss.Nuprajur is not null and WOcorr.us <> 'ALUNO')
  )
and
  (
    WOcorrAss.Id = p_WOcorrAss_Id
  or
    p_WOcorrAss_Id is null
  )
and
 (
    WOcorr.Campus_Id = p_Campus_Id
  or
    p_Campus_Id is null
  or
    WOcorr.Campus_Id is null
  )
and
  WOcorr.WOcorrAss_id = WOcorrAss.Id
and
  (
    WOcorr.State_Id = 3000000011002
  or
    WOcorr.State_Id = 3000000011004 
  )
and
  (
    WOcorr.WPessoa_Id = p_WPessoa_Id
  or
    p_WPessoa_Id is null
  )
and
  WOcorrFluxo.WOcorr_Id = WOcorr.Id
and
  WOcorrFluxo.State_Id = 3000000025001
and
  WOcorrFluxo.Depart_Id = nvl( p_Depart_Id ,0) 
order by
  Aluno
