select
  WOcorr.Id                                                                       as Id,
  WPessoa_gsRecognize(WOcorr.WPessoa_Id)                                          as WPessoa_Recognize,
  WPessoa_gnCodigo(WOcorr.WPessoa_Id)                                             as WPessoa_Codigo,
  to_char(WOcorr.Dt,'dd/mm/yyyy HH24:mi')                                         as Data,
  WOcorr.Us                                                                       as Usuario,
  State_gsRecognize(WOcorr.State_id)                                              as Situacao,
  nvl(Num,WOcorr_gnNumOcorrencia(WOcorr.Id))                                      as Ocorrencia,
  Campus_gsRecognize(Campus_Id)                                                   as Campus_Recognize,
  WOcorrAss.Nomenet                                                               as WOcorrAss_Recognize
from
  WOcorr,
  WOcorrAss
where
  (
    WOcorrass_Id = p_WOcorrAss_Id
  or
    p_WOcorrAss_Id is null
  )
and
  WOcorrass.Nuprajur = 'on'
and
  WOcorr.WOcorrAss_Id = WOcorrAss.Id
and
  (
    WOcorr.Campus_Id = p_Campus_Id
  or
    p_Campus_Id is null
  )
and
  (
    WOcorr.State_Id = p_WOcorr_State_Id
  or
    p_WOcorr_State_Id is null
  )
and
  trunc(WOcorr.Dt) between p_O_Data1 and p_O_Data2
order by
  WPessoa_Recognize
