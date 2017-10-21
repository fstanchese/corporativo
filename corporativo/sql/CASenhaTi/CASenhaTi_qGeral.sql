select
	CASenhaTi.*,
	CAAssunto_gsRecognize(CAAssunto_Id)         as Assunto,
	descricao As Recognize
from
	CASenhaTi
	
order by
	Assunto, Recognize
	