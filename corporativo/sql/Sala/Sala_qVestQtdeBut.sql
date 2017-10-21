select 
  nvl( sum(VestAlocados) ,0) as TOTAL 
from 
  Sala 
where 
  VestOrdem is not null
and
  Campus_Id = 6400000000002