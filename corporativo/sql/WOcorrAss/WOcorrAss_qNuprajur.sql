
select
  WOcorrAss.*,
  NomeNet as Recognize
from
  WOcorrAss
where 
  CEPA is null
and
  nomenet is not null
and
  Nuprajur is not null
order by
  NomeNet
