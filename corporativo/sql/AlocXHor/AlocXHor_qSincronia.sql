select
  AlocXHor.* 
from
  AlocXHor
where
  AlocXHor.Indice = nvl ( p_O_Numero , 0 )
and
  AlocXHor.AlocaProf_Id = nvl ( p_AlocaProf_Junto_Id , 0 )

