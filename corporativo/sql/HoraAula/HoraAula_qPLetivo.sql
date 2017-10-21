select 
  Id,
  Nome as Recognize
from 
  PLetivo 
where 
  (
     p_Ciclo_Id is null
     or
     PLetivo.Ciclo_Id = nvl ( p_Ciclo_Id , 0)
  )
and
  Trunc(Final) > Trunc(Sysdate) - 300
order by 2