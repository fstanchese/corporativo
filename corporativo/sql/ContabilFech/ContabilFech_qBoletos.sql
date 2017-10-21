(
 select
 	contabilcur.nome            	as Curso,
 	replace(boleto.valor,',','.')	as Valor,
	boleto.id 						as Boleto_Id,
	boletoti_id                     as BoletoTi_Id,
	state_base_id                   as State_Base_Id,
	boleto.curso_id                 as curso_id
from
	boleto,
	contabilcur
where
	contabilcur.curso_id (+) = boleto.curso_id
and
	state_base_id <> 3000000000001
and
	to_date(boleto.dt) <= to_date( nvl ( p_O_Data , sysdate ) )			
and
	boletoti_id = 92200000000003
and
	boleto.campus_id = nvl ( p_Campus_Id, 0 )
and
	competencia = nvl ( p_Boleto_Competencia, 0 )
)
union
(
select
	contabilcur.nome             as Curso,
 	replace(boleto.valor,',','.') 	as Valor,
	boleto.id						as Boleto_Id,
	boletoti_id                     as BoletoTi_Id,
	state_base_id                   as State_Base_Id,
	boleto.curso_id                 as curso_id
from
	boleto,
	contabilcur
where
	contabilcur.curso_id (+) = boleto.curso_id
and
	state_base_id = 3000000000004
and
	to_date(boleto.dt) <= to_date( nvl ( p_O_Data , sysdate ) )			
and
	boletoti_id = 92200000000008
and
	boleto.campus_id = nvl ( p_Campus_Id, 0 )
and
	competencia = nvl ( p_Boleto_Competencia, 0 )
)
union
(
select
	contabilcur.nome            	as Curso,
	replace(boleto.valor,',','.')	as Valor,
	boleto.id 						as Boleto_Id,
	boletoti_id                     as BoletoTi_Id,
	state_base_id                   as State_Base_Id,
	boleto.curso_id                 as curso_id
from
	boleto,
	contabilcur
where
	contabilcur.curso_id (+) = boleto.curso_id
and
	not exists (select boletoitem.id from boletoitem where state_id=3000000017001 and boleto.id=boleto_id)
and
	state_base_id <> 3000000000001
and
	to_date(boleto.dt) <= to_date( nvl ( p_O_Data , sysdate ) )			
and
	boletoti_id = 92200000000003
and
	boleto.campus_id = nvl ( p_Campus_Id, 0 ) 
and
	competencia = nvl ( p_Boleto_Competencia, 0 )
)							
order by 1,3