select 
  PLetivo.*,
  PLetivo_gsRecognize(PLetivo.Id) as Recognize
from 
  pletivo 
where 
  nvl( p_O_Data ,trunc(sysdate)) between trunc(PLetivo.Inicio) and trunc(PLetivo.Final) 
and 
 ( 
   p_Ciclo_Id is null
   or
   PLetivo.Ciclo_Id = nvl ( p_Ciclo_Id , 0 )
 ) 
order by PLetivo.Nome desc