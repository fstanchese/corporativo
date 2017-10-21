select 
  count(*) as COUNT
from 
  VestCla
where
  VestCla.Matric_Id = nvl( p_Matric_Id ,0 )
