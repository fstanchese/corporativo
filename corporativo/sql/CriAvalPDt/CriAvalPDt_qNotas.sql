select
  CriAvalPDt.*,
  CriAvalPDt_gsRecognize(Id) as Recognize,
  PLetivo_gsrecognize(CriAvalPDt.PLetivo_Id)   as PLETIVO_RECOGNIZE,
  CriAvalP_gsrecognize(CriAvalPDt.CriAvalP_Id) as CRIAVALP_RECOGNIZE
from 
  CriAvalPDt
where
  CriAvalPDt.PLetivo_Id = nvl( p_PLetivo_Id ,0 )