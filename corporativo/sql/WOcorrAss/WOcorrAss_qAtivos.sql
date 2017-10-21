select
  WOcorrAss.NomeNet as Recognize,
  WOcorrAss.* 
from
  WOcorrAss
where
  nomenet is not null
and
  ativo='on'
order by 
  Nomenet
