oDoc ( ) 

select
  Empresa.*,
  Empresa_gsRecognize(Id) as Recognize 
from
  Empresa
order by
  Recognize 
