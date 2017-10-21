
select 
  Sala.*,
  Sala_gsRecognize(Sala.Id) as Recognize 
from 
  Sala 
where
  UsarNoVest = 'on'
order by
  Codigo 
