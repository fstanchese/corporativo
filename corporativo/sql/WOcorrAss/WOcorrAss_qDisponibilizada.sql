select 
  WOcorrAss.*,
  wtxServico_gsValor(wocorrass.wtxServico_id) as valor,
  wtxServico_gsPreco(wocorrass.wtxServico_id) as valorNumerico,
  wtxServico_gnValor(wocorrass.wtxServico_id) as valor2,
  WOcorrAss.Nomenet                           as Recognize
from 
  WOcorrAss
where
  Nuprajur is null
and
  upper(disponibilizada) = 'ON'
order by 
  nomenet

