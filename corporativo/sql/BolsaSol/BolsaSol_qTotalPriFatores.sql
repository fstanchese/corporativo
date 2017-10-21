select 
  nvl(rendaprimes,0)*rendati.bolsafator as SOMA
from
  bolsasol,
  rendati
where
  nvl(bolsasol.rendati_pri_id,78600000000001) = rendati.id
and
  bolsasol.id = nvl( p_BolsaSol_Id ,0)
