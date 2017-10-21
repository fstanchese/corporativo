select
	Cidade.*,
	Cidade_gsRecognize(Cidade.Id) as Recognize
from
	Cidade
order by
	Recognize 