select
  wpessoa_gncodigo(WPessoa_Id)        as WPessoa_Codigo,
  wocorr.id                           as WOcorr_Id,
  WOcorr_gnNumOcorrencia(WOcorr.Id)   as NumOcorrencia,
  WPessoa_gsRecognize(WPessoa_Id)     as WPessoa_Nome,
  WOcorr.Dt                           as WOcorr_Dt,
  WOcorrAss_gsRecognize(WOcorrAss_Id) as WOcorrAss_Recognize
from
  WOcorr
where
  not exists (select WOcorr_Id from WOcorrFluxo where wocorr_id=WOcorr.Id)
and
  trunc(WOcorr.Dt) between p_O_Data1 and p_O_Data2 
and
  state_id=3000000011003
order by dt
