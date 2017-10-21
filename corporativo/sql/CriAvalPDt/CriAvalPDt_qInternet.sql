select
  Id,
  CriAvalP_Id,
  PLetivo_Id,
  CriAvalPDt_gsRecognize(Id) as Recognize
from 
  CriAvalPDt
where
  CriAvalPDt.Internet = 'on'
order by pletivo_id desc



