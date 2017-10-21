select
  Apostila.* 
from
  Apostila
where
  Apostila.DiplProc_Id in
  ( select DiplProc.Id from DiplProc where state_id <> 3000000026011 start with DiplProc.Id = nvl( p_DiplProc_Id ,0) connect by PRIOR DiplProc_Pai_Id = DiplProc.Id )
order by apostila.diplproc_id,PeriodoLetivo,Apostila.Id