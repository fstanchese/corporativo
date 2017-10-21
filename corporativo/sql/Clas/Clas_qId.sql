select
  *
from
  Class
where
  Id = nvl( p_Class_Id ,0)
