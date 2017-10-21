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
where
  (
    CurrOfe.Periodo_Id = p_Periodo_Id
  or
    p_Periodo_Id is null
  )
and
  (
    CurrOfe.Campus_Id = p_Campus_Id
  or
    p_Campus_Id is null
  )
and
  PROUNI = 'on'
order by
  Recognize