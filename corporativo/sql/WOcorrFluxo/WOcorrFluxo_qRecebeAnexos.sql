select
  WOcorrFluxo.DtAnexo                          as DtAnexo,
  WOcorr.Id                                    as WOcorr_Id,
  WOcorrFluxo.Id                               as WOcorrFluxo_Id,
  WOcorr_gnNumOcorrencia(WOcorr.Id)            as NrOcorren,
  WPessoa_gsRecognize(WOcorr.WPessoa_Id)       as Aluno,
  WOcorrAss.NomeNet                            as Assunto,
  to_char(WOcorrFluxo.Dt,'dd/mm/yyyy hh24:mi') as DataHora,
  WOcorr_gnNumOcorrencia(WOcorr.Id)            as NumOcorrencia,
  Campus_gsRecognize(WOcorr.Campus_Id)         as Campus
from
  WOcorrFluxo,
  Campus,
  WOcorr,
  WOcorrAss
where
  WOcorr.Campus_Id = Campus.Id
and
  WOcorr.WOcorrAss_Id = WOcorrAss.Id
and
  WOcorrFluxo.Dt = (select max(dt) from WOcorrFluxo where WOcorr_Id = WOcorr.Id)
and
  WOcorr.State_Id = 3000000011002
and
  WOcorrFluxo.WOcorr_Id = WOcorr.Id
and
  WOcorrFluxo.DtAnexo is null
and
  WOcorrFluxo.Depart_Id = p_Depart_Id
order by 
  Aluno, WOcorr.Dt
