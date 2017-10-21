select
	CCobCartaTi.*,
	CCobCartaTi.Nome as Recognize
from
	CCobCartaTi
where
	CCobCartaTi.Exibir = 'on'
order by
	CCobCartaTi.Nome