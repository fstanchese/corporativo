
select
  WOcorrAss.*,
  NomeNet as Recognize
from
  WOcorrAss
where 
  nomenet is not null
order by
  NomeNet
