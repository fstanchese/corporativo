select
  WOcorrAss.*,
  NomeNet as Recognize
from
  WOcorrAss
where 
  nomenet is not null
and
  Nuprajur is not null
and
  CEPA is not null
order by
  NomeNet
