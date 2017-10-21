select
  WPessoa_gsRecognize(WOcorr.WPessoa_Id)     as WPessoa_Recognize,
  WOcorrAss_gsRecognize(Wocorr.WOcorrAss_Id) as WOcorrAss_Recognize,
  WOcorr.Num                                 as Numero,
  WOcorrInf.Informacao                       as Informacao,
  WOcorrInf.Conteudo                         as Conteudo
from
  WOcorr,
  WOcorrInf
where
  WOcorr.Id = WOcorrInf.WOcorr_Id
and
  WOcorr.Num = p_WOcorr_Numero
and
  WOcorr.US = 'ALUNO'
order by 
  WOcorrInf.Id
