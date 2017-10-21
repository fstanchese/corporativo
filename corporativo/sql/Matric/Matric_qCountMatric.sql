select 
  Count(Id) as NumMatric
from 
  Matric
where
  Matric.MatricTi_Id = 8300000000001
and
 (
    p_State_Id is null
      or
    Matric.State_Id = nvl( p_State_Id ,0) 
  )
and
  Matric.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0)
