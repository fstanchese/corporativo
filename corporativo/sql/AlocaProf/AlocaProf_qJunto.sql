select
  AlocaProf.*
from
  AlocaProf
where
  AlocaProf.Id = nvl ( p_AlocaProf_Id , 0 )

