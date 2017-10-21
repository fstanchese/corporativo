select
	Sala.*,
	Sala.Codigo as Recognize
from
	Sala
where
	translate(upper(sala.codigo),'ацимстзгй','AAEIOOUCE') like replace( trim( translate(upper( p_Sala_Codigo ),'ацимстзгй','AAEIOOUCE') ),' ','%')||'%'
order by
	Codigo
 