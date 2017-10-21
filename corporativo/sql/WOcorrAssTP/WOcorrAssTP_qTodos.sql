select
  WOcorrAss_gsRecognize(WOcorrAss_Id) as WOcorrAss_Recognize,
  Referencia,
  Descricao,
  WOcorrAss_Id,
  trim(ativo) as ativo
from
  WOcorrAssTP 
order by 1,2,3