select
  id 
from
  WocorrIsento
where
  PLetivo_Id = nvl( p_PLetivo_Id , 0)
and
  Matric_Id = nvl( p_Matric_Id , 0)
