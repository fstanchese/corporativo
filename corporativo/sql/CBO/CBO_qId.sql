select
  CBO.*
from
  CBO
where
  Id =nvl( p_CBO_Id ,0)
