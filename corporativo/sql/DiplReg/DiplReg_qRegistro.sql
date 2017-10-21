select
  DiplReg.*
from
  DiplReg
where
  DiplReg.Registro = nvl ( p_DiplReg_Registro , 0 )
  