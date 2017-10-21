select 
  Count(Id) as NumMatric
from 
  Matric
where
  State_Id in (3000000002002,3000000002003)
and
  (
    Matric.Rematricula <= p_O_Data2
  or
    p_O_Data2 is null
  )
and
  (
    Matric.Data <= p_O_Data1
  or
    p_O_Data1 is null
  )
and
  Matric.MatricTi_Id = 8300000000001
and
  Matric.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0 )