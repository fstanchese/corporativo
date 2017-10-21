select
  CurrOfe.Id as Id 
from
  CurrOfe
where
  CurrOfe.Curr_Id = nvl ( p_Curr_Id , 0 )        
and
  CurrOfe.Periodo_Id = nvl ( p_Periodo_Id , 0 )
and
  CurrOfe.Campus_Id = nvl ( p_Campus_Id , 0 )
and
  CurrOfe.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
