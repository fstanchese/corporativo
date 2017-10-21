select
  WOcorr.Id                           as WOCORR_ID,
  WOcorr_gnNumOcorrencia(WOcorr.Id)   as Numero,
  WPessoa_gnCodigo(WOcorr.WPessoa_Id) as RA,
  WOcorrAss.NomeNet                   as Assunto,
  State_gsRecognize(WOcorr.State_Id)  as Situacao,
  WOcorr.Dt                           as Data
from 
  WOcorr, 
  WOcorrAss,
  TeleAssunto
where
  TeleAssunto.State_Id(+) <> 3000000010003
and
  TeleAssunto.WOcorr_Id(+) = WOcorr.Id
and
  WOcorrAss.Id = WOcorr.WOcorrAss_Id
and
  WOcorr.State_Id = 3000000011007 
order by
  Data