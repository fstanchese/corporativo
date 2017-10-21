select
	Banco.*,
	Banco_gsRecognize(Banco.Id) as Recognize
from
	Banco
where
	Banco.Id = p_Banco_Id 