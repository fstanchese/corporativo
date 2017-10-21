
select 
  wocorrass.*,
  wocorrass_gsRecognize(wocorrass.id) as recognize,
  wtxServico_gsValor(wocorrass.wtxServico_id) as valor,
  wtxServico_gsPreco(wocorrass.wtxServico_id) as valorNumerico,
  wtxServico_gnValor(wocorrass.wtxServico_id) as valor2 
from
  wocorrass
where 
  id = nvl( p_WOcorrAss_Id ,0) 
