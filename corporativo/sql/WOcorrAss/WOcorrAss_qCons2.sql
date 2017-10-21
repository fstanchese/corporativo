
select
  wocorrass.*,
  wtxServico_gsValor(wocorrass.wtxServico_id) as valor,
  WOcorrAss.Nomenet                           as Recognize
from 
  wocorrass 
where
$v_selecao
  ativo = 'on'
and
  (
    substr(upper(nomenet),1,1) = p_WOcorrAss_PrimeiraLetra
  or
    p_WOcorrAss_PrimeiraLetra is null
  )
and
  nuprajur is null
and
  disponibilizada = 'on'
and
  nomenet is not null 
and
  id not in ( select autorel from wocorrass where autorel is not null )
order by
  $v_OrderBy nomenet
