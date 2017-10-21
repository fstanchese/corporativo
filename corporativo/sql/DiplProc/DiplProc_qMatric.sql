select
  DiplProc.*,
  State_gsRecognize(DiplProc.State_Id)                as State,
  substr(nrprocesso,5,6)||'/'||substr(nrprocesso,1,4) as NumProc  
from
  DiplProc  
where
  DiplProc.Matric_Id = nvl ( p_Matric_Id ,0)  
order by id desc
