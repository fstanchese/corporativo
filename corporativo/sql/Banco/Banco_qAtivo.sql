select
	Banco.*,
	Banco_gsRecognize(Banco.Id) as Recognize
from
	Banco
where
	Banco.Ativo = 'on'
order by 
	Recognize
	