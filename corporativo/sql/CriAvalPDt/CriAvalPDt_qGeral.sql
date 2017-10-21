select
  CriAvalPDt.*,
  CriAvalPDt_gsRecognize(CriAvalPDt.Id)        as Recognize,
  PLetivo_gsrecognize(CriAvalPDt.PLetivo_Id)   as PLETIVO_RECOGNIZE,
  CriAvalP_gsrecognize(CriAvalPDt.CriAvalP_Id) as CRIAVALP_RECOGNIZE,
  decode(internet,'on','Sim','off','Não')      as Internet
from
  CriAvalPDt
order by
  1 desc