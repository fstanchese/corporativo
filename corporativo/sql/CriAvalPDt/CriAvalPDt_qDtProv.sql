select
  count(*) as TOTAL
from
  CriAvalP,
  CriAvalPDt
where
  trunc(CriAvalPDt.dtIniProv) <= p_DataProva
and
  trunc(CriAvalPDt.dtTerProv) >= p_DataProva
and
  CriAvalP.Id = CriAvalPDt.CriAvalP_Id
and
  CriAvalP.Id = nvl( p_CriAvalP_Id ,0)
and 
  CriAvalPDt.PLetivo_Id = nvl( p_PLetivo_Id ,0)
