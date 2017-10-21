select
  EveHorario.*,
  EveHorario_gsRecognize(Id) as Recognize
from
  EveHorario
order by
  Recognize