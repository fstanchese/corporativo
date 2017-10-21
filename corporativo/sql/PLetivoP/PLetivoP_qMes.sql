select
  PLetivoP.*,
  PLetivoP_gsRecognize (PLetivoP.Id) as RECOGNIZE
from
  PLetivoP
where
  Mes_Id = nvl ( p_Mes_Id , 0)
and
  PLetivo_Id = nvl( p_PLetivo_Id ,0)
