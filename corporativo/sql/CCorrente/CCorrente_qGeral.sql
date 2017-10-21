select 
  CCorrente.*, 
  CCorrente_gsRecognize(Id)  as  Recognize 
from 
  CCorrente 
order by 
  Recognize 
