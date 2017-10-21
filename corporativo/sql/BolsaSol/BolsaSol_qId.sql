select
  BolsaSol.*,
  nvl(RENDAPRIMES,0) as RENDAPRIMES_N,
  nvl(RENDAOUTMES,0) as RENDAOUTMES_N
from
  BolsaSol
where
  id = p_BolsaSol_Id
