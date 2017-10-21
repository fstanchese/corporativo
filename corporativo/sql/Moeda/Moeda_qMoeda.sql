oDoc ( ) 

select
  Moeda.*, 
  Moeda_gsRecognize(Moeda.Id) as Recognize
from
  Moeda
where
  MoedaTi_Id = 58900000000001
order by
  Recognize
