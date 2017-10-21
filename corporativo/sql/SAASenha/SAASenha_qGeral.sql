select
  SAASenha.*,
  SAAMesa_gsRecognize(SAAMesa_Id) as SAAMesa
from
  SAASenha
order by id