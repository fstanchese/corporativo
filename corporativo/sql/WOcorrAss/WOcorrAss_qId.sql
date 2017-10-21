select 
  WOcorrAss.*,
  wtxServico_gsValor(wocorrass.wtxServico_id) as valor,
  wtxServico_gsPreco(wocorrass.wtxServico_id) as valorNumerico,
  wtxServico_gnValor(wocorrass.wtxServico_id) as valor2,
  WOcorrAss_gsRecognize(WOcorrAss.Id)         as WOcorrAss_Id_r
from 
  wocorrass
where
  id = nvl( p_WOcorrAss_Id ,0) 
