select
  matric_pai_id
from
  Matric
where
  Matric.Id = nvl ( p_Matric_Id , 0 )

