select
  SalaTi.*,
  SalaTi.Nome as Recognize
from
  SalaTi
where
  SalaTi.SalaTi_Pai_Id in (142500000000024,142500000000026)
order by Recognize
