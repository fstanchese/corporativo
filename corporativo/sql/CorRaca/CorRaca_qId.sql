select
  CorRaca.* 
from
  CorRaca
where
  CorRaca.Id = nvl ( p_CorRaca_Id , 0 )

