select
	Cidade.*,
	Cidade_gsRecognize(Cidade.Id) as Recognize
from
	Cidade
where
	Cidade.Estado_Id = p_Estado_Id 
order by
	Cidade.Nome