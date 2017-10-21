select
  Id,
  FaltaAbono_gsRecognize(Id) as Recognize
from
  FaltaAbono
order by 
  Nome
  