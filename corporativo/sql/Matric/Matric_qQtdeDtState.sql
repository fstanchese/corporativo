select 
  nvl(Count(Id),0) as Total
from 
  Matric
where
  State_Id = nvl ( p_State_Id , 0 )
and
  Matric.DtState < nvl( p_O_Data1 , trunc(sysdate) )  
and
  Matric.MatricTi_Id = nvl ( p_MatricTi_Id , 8300000000001 )
and
  Matric.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0 )