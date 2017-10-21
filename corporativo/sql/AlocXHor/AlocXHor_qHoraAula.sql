select
  AlocXHor.* 
from
  AlocXHor
where
  AlocXHor.Indice = nvl ( p_AlocXHor_Indice , 0 )
and
  AlocXHor.AlocaProf_Id = nvl ( p_AlocaProf_Id , 0 )

