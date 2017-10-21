select 
	AutDoc.*,
	to_char(AutDoc.Dt,'dd/mm/yyyy hh24:mi:ss') as Dt_Format 
from 
	AutDoc,
	Matric
where 
 	AutDoc.Matric_Id = Matric.Id
and
	Matric.WPessoa_Id = p_WPessoa_Id 
and 
	RowNum < p_O_QtdeMax  
order by AutDoc.Id desc 