select
  PLetivoP.*,
  PLetivoP_gsRecognize (PLetivoP.Id) as RECOGNIZE
from
  PLetivoP
where
  DtGeracao is not null
and
  PLetivo_Id = nvl( p_PLetivo_Id ,0)
order by Ciclo_Id, DtInicial
