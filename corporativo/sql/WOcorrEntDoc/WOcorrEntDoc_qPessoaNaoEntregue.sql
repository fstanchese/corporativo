select
  WOcorr_gnNumOcorrencia(WOcorr.Id)   as NumOcorrencia,
  WPessoa_gsRecognize(WPessoa_Id)     as WPessoa_Nome,
  WOcorr.Dt                           as WOcorr_Dt,
  WOcorrAss_gsRecognize(WOcorrAss_Id) as WOcorrAss_Recognize
from
  WOcorr,
  WOcorrAss
where
  WOcorr_gsRetDeferimento(WOcorr.Id) = 'Deferido'
and
  not exists (select WOcorr_Id from WOcorrEntDoc where WOcorr_Id = WOcorr.Id)
and
  (
    WOcorrAss.DescSaida is not null
  or
    WOcorrAss.Id in (5100000000035,5100000000335,5100000000342)
  ) 
and
  WOcorr.WOcorrAss_Id = WOcorrAss.Id
and
  WOcorr.State_Id = 3000000011003 
and
  to_char(WOcorr.Dt,'yyyy') = p_O_Ano 
and
  WOcorr.WPessoa_Id = p_WPessoa_Id 
