select 
	count(*) as Qtde 
from 
	SisMenu 
where 
	Nome = p_SisMenu_Nome 
and
	Raiz = p_SisMenu_Raiz 
and 
	WPessoa_Id = p_WPessoa_Id 	