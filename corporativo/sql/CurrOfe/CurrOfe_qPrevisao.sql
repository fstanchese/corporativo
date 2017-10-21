select
  CurrOfe.Id as CurrOfe_Id
from
  CurrOfe
where
  PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
and
  Campus_Id = nvl ( p_Campus_Id , 0 )
and
  Periodo_Id = nvl ( p_Periodo_Id , 0 )
and
  Curr_Id = nvl ( p_Curr_Id , 0 )

