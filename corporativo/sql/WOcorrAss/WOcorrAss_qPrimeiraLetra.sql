select
  distinct(substr(upper(nomenet),1,1))  as Letra
from
  WOcorrAss
where
  $v_selecao
  ativo = 'on' 
and
  nuprajur is null
and
  disponibilizada = 'on'
order by Letra