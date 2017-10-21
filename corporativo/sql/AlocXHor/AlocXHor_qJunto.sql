select
  AlocXHor.AlocaProf_Junto_Id,
  AlocXHor.AlocaProf_Id,
  AlocXHor.Indice  
from
  AlocXHor
where
  AlocXHor.AlocaProf_Junto_Id = nvl ( p_AlocaProf_Id , 0 )
union
select
  AlocXHor.AlocaProf_Junto_Id,
  AlocXHor.AlocaProf_Id,
  AlocXHor.Indice  
from
  AlocXHor
where
  AlocXHor.AlocaProf_Junto_Id is not null
and
  AlocXHor.AlocaProf_Id = nvl ( p_AlocaProf_Id , 0 )

