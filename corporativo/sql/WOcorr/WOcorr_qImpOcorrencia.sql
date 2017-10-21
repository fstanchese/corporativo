(
select
  WOcorr.Id                                     as WOCORR_ID,
  WOcorr_gnNumOcorrencia(WOcorr.Id)             as Numero,
  WPessoa_gnCodigo(WPessoa_Id)                  as RA,
  WOcorrAss.NomeNet                             as Assunto,
  State_gsRecognize(WOcorr.State_Id)            as Situacao,
  WOcorr.Dt                                     as Data,
  shortname(WPessoa_gsRecognize(WPessoa_Id),20) as Aluno
from 
  WOcorr,
  WOcorrAss,
  WOcorrAssFlu
where
  (
    Wocorr.Campus_Id = p_Campus_Id
  or
    p_Campus_Id is null
  )
and
  trunc(WOcorr.Dt) between to_date( p_O_Data1 ) and to_date( p_O_Data2 )
and
  WOcorr.WOcorrAss_Id = p_WOcorrAss_Id
and
  WOcorrAssFlu.Sequencia = 1
and
  WOcorrAssFlu.Depart_Id = nvl( p_Depart_Id ,0)
and
  WOcorrAssFlu.WOcorrAss_Id = WOcorrAss.Id
and
  WOcorrAss.Id = WOcorr.WOcorrAss_Id
and
  WOcorr.Id not in (select WOcorr_Id from WOcorrFluxo )
and
  (
    WOcorr.WPessoa_Id = p_WPessoa_Id
  or
    p_WPessoa_Id is null
  )
and
  WOcorr.State_Id = p_WOcorr_State_Id 
)
union
(
select
  WOcorr.Id                                            as WOCORR_ID,
  WOcorr_gnNumOcorrencia(WOcorr.Id)                    as Numero,
  WPessoa_gnCodigo(WOcorr.WPessoa_Id)                  as RA,
  WOcorrAss.NomeNet                                    as Assunto,
  State_gsRecognize(WOcorr.State_Id)                   as Situacao,
  WOcorr.Dt                                            as Data,
  shortname(WPessoa_gsRecognize(WOcorr.WPessoa_Id),20) as Aluno
from 
  WOcorr, 
  WOcorrAss,
  WOcorrFluxo
where
  (
    Wocorr.Campus_Id = p_Campus_Id
  or
    p_Campus_Id is null
  )
and
  trunc(WOcorr.Dt) between to_date( p_O_Data1 ) and to_date( p_O_Data2 )
and
  WOcorr.WOcorrAss_Id = p_WOcorrAss_Id
and
  WOcorr.WOcorrAss_id = WOcorrAss.Id
and
  WOcorrFluxo.Dt = (select max(dt) from WOcorrFluxo where WOcorr_Id = WOcorr.Id)
and
  WOcorrFluxo.Depart_Id = nvl( p_Depart_Id ,0)
and
  WOcorrFluxo.DtAnexo is not null
and
  WOcorrFluxo.WOcorr_Id = WOcorr.Id
and
  (
    WOcorr.WPessoa_Id = p_WPessoa_Id
  or
    p_WPessoa_Id is null
  )
and
  WOcorr.State_Id = p_WOcorr_State_Id 
)
order by
  Data
