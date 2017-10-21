select
	BoletoTi.*,
	BoletoTi.Nome as Recognize
from
	BoletoTi
where
	BoletoTi.CCob = 'on'
order by
	BoletoTi.Nome