select
  AlocXHor.*,
  AlocaProf.CHS1,
  AlocaProf.CHS2,
  AlocaProf.CHS3,
  AlocaProf.CHS4,
  AlocaProf.CHS5,
  AlocaProf.CHS6
from
  AlocXHor,
  AlocaProf
where
  AlocXHor.AlocaProf_Id = AlocaProf.Id
and
  AlocXHor.AlocaProf_Id = nvl ( p_AlocaProf_Id , 0 )
and
  AlocXHor.Indice = nvl ( p_O_Numero , 0 )

