select
  WOcorrFluxo.Id,
  WOcorr_gnNumOcorrencia(WOcorr.Id)                as Num_Ocorr,
  WPessoa_gnCodigo(WPessoa_Id)                     as Codigo,
  WPessoa_gsRecognize(WPessoa_Id)                  as Aluno,
  WOcorrAss.NomeNet                                as Assunto,
  to_char(WOcorrFluxo.dt,'dd/mm/yyyy hh24:mi:ss')  as data_hora,
  to_char(WOcorr.dt,'dd/mm/yyyy hh24:mi:ss')       as data_solicitacao,
  Depart_gsRecognize(WOcorrFluxo.Depart_Id)        as Departamento,
  WOcorr_gdVencimento(WOcorr.Id)                   as Vencimento,
  WOcorr.Id                                        as WOcorr_Id
from
  WOcorrFluxo,
  WOcorr,
  WOcorrAss
where
  (
    WOcorrAss.Id = p_WOcorrAss_Id
  or
    p_WOcorrAss_Id is null
  )
and
  trunc(WOcorrFluxo.Dt) between p_O_Data1 and to_date( p_O_Data2 , 'dd/mm/yyyy hh24:mi:ss') 
and
  WOcorr.WOcorrAss_Id = WOcorrAss.Id 
and
  WOcorrFluxo.WOcorr_Id = WOcorr.Id
and
  WOcorrFluxo.Depart_Id = p_Depart_Id
order by
  Assunto, WOcorrFluxo.dt