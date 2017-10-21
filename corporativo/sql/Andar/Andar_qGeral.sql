select
  Andar.*,
  Andar_gsRecognize(id) as Recognize
from
  Andar
order by 
  Andar.Nome