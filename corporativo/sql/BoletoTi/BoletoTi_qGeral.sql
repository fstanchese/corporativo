select
   BoletoTi.*,
   Nome as Recognize
from
   BoletoTi
where
	trim(Exibir) = 'on'
order by
  Recognize