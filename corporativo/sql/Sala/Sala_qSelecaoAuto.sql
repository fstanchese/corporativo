select
	Sala.*,
	Sala.Codigo as Recognize
from
	Sala
where
	translate(upper(sala.codigo),'���������','AAEIOOUCE') like replace( trim( translate(upper( p_Sala_Codigo ),'���������','AAEIOOUCE') ),' ','%')||'%'
order by
	Codigo
 