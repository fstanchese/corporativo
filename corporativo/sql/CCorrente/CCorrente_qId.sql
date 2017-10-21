
select 
  CCorrente.*, 
  CCorrente_gsRecognize(Id)  as  Recognize 
from 
  CCorrente 
where 
  id = nvl( p_CCorrente_Id ,0)
