select
	Banco.*,
	Banco_gsRecognize(Banco.Id) as Recognize
from
	Banco
order by Recognize 