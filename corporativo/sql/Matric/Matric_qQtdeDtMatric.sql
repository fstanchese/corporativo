select 
  Count(Id) as Total
from 
  Matric
where
  Matric.MatricTi_Id = nvl ( p_MatricTi_Id , 8300000000001 )
and
  ( 
    ( 
      Matric.State_Id in ( 3000000002002,3000000002003,3000000002010,3000000002011,3000000002012 )
      and
      trunc(Matric.Data) < nvl( p_O_Data1 , trunc(sysdate) )
    )
    or
    (
      Matric.State_Id in ( 3000000002004,3000000002005,3000000002006,3000000002007,3000000002008,3000000002009 ) 
      and 
      trunc(Matric.DtState) >= nvl( p_O_Data1 , trunc(sysdate) ) 
    ) 
  ) 
and
  Matric.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0)
