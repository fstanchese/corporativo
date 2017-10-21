select
  AlocXHor.* 
from
  AlocXHor
where
  AlocXHor.AlocaProf_Id = nvl ( p_AlocaProf_Id , 0 )

