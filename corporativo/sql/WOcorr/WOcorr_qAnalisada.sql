select
  WOcorr_gnNumOcorrencia(WOcorr.Id)          as Num_Ocorrencia,
  WPessoa.Nome                               as WPessoa_Nome,
  WPessoa.Codigo                             as WPessoa_Codigo,
  State_gsRecognize(WOcorr.State_Id)         as WOcorr_State,
  WOcorrAss_gsRecognize(WOcorr.WOcorrAss_Id) as WOcorrAss_Recognize,
  WOcorr.Dt                                  as WOcorr_Dt,
  WOcorrHi.Dt                                as WOcorrHi_Dt,
  WOcorrHi.US                                as Usuario,
  WOcorr.Id                                  as WOcorr_Id
from
  WOcorr,
  WOcorrHi,
  WPessoa
where
  WOcorr.WPessoa_Id = WPessoa.Id
and
  WOcorr.Id = WOcorr_Id
and
  (
    WOcorrHi.Us = p_O_Us
  or
    p_O_Us is null
  )
and
  trunc(WOcorrHi.Dt) between p_O_Data1 and p_O_Data2
and
  WOcorrHi.Old = '3000000011001'
and
  upper(WOcorrHi.Col) = 'STATE_ID'
order by
  WPessoa.Nome