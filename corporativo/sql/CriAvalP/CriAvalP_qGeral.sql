select
  CriAvalP.*,
  CriAvalP_gsRecognize(Id) as Recognize
from
  CriAvalP
order by id