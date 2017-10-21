select
  PLetivoP.*
from
  PLetivoP
where
  PLetivoP.id = nvl( p_PLetivoP_Id ,0)
