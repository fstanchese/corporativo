select
  max(WOcorrFluxo.Id)                               as MAX,
  WOcorr_gnNumOcorrencia(WOcorr.Id)                 as NUMERO,
  WPessoa_gnCodigo(WOcorr.WPessoa_Id)               as RA,
  shortname(WPessoa_gsRecognize(WOcorr.WPessoa_Id)) as NOMEALUNO,
  WOcorr.Id                                         as WOCORR_ID,
  WOcorr.WOcorrAss_Id 
from
  WOcorr,
  WOcorrFluxo
where
  WOcorr.Id = WOcorrFluxo.WOcorr_Id
and
  ( WOcorr.Campus_Id = p_Campus_Id or p_Campus_Id is null )
and
  WOcorrFluxo.Depart_Id = 36000000000063
and
  ( WOcorr.State_Id = p_State_Id or p_State_Id is null )
and
  WOcorr.WOcorrAss_Id in (5100000000017,5100000000089)
group by WOcorr.WPessoa_Id, WOcorr.Id, WOcorr.WOcorrAss_Id
order by 2