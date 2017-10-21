select
	CASenhaTi.*,
	CAAssunto.CAEvento_Id as CAEvento_Id
from
	CASenhaTi, CAAssunto
where
	CAAssunto.Id = CASenhaTi.CAAssunto_Id
	AND
	CASenhaTi.Id = p_CASenhaTi_Id
			
order by
	CASenhaTi.Descricao