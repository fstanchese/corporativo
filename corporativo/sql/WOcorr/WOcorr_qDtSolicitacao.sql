select
  to_char(WOcorr.Dt,'dd/mm/yyyy')            as Dt,
  State_gsRecognize(State_Id)                as Situacao,
  WOcorr.Id                                  as Id,
  WPessoa_gsRecognize(WPessoa_Id)            as WPessoa_Recognize,
  to_char(WOcorr.Dt,'dd/mm/yyyy HH24:mi')    as Data,
  Us                                         as Usuario,
  nvl(Num,WOcorr_gnNumOcorrencia(ID))        as Ocorrencia,
  WOcorr.WOcorrAss_Id                        as WOcorrAss_Id,
  WOcorrass_gsRecognize(WOcorr.WOcorrAss_Id) as WOcorrAss_Recognize
from
  WOcorr
where
  (
    WOcorr.Campus_Id = p_Campus_Id
  or
    p_Campus_Id is null
  )
and
  trunc(dt) between p_O_Data1 and p_O_Data2
order by
  WOcorr.Dt,WPessoa_Recognize
