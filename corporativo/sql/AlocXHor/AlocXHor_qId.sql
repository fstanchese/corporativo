select
  alocxhor.*
from
  alocxhor
where
  alocxhor.id = nvl ( p_AlocXHor_Id , 0 )
