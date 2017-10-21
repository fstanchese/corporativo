
select   
  Id,  
  Curr_Id,  
  Periodo_Id,  
  Campus_Id,  
  PLetivo_Id,  
  CurrOfe_gsRecognize(Id)   as Recognize,  
  Curr_gsRecognize(Curr_Id) as Curr_Recognize  
from   
  CurrOfe 
order by
  Recognize