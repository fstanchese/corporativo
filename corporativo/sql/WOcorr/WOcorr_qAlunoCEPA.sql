
select
  WOcorr.Id                                         as Id,
  nvl(WOcorr.Num,WOcorr_gnNumOcorrencia(WOcorr.Id)) as num,
  WOcorr.Solicitacao                                as Solicitacao,
  State_gsRecognize(WOcorr.State_Id)                as SITUACAO,
  WOcorrAss.NomeNet                                 as ASSUNTO,
  to_char(WOcorr.Solicitacao,'dd/mm/yyyy')          as SOLICITACAO,
  WOcorr_gsRecognize(WOcorr.Id)                     as Recognize,
  WOcorr.State_Id                                   as State_Id
from 
  WOcorr,
  WOcorrAss
where
  WOcorrAss.CEPA = 'on'
and
  WOcorr.WOcorrAss_Id = WOcorrAss.Id
and
  WOcorr.WPessoa_Id = nvl( p_WPessoa_Id ,0)
order by
  num desc