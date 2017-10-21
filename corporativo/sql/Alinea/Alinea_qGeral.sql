
select
  Alinea.*,
  Alinea_gsRecognize(Id) as Recognize
from
  Alinea
order by 
  Alinea
  