select
	ProfDisponivel.*,
	WPessoa_gsrecognize(ProfDisponivel.WPessoa_Id) as Nome,
	decode(confirmado,'on','sim','off','não',null,'não') as Confirmado
from
	ProfDisponivel
where
    ProfDisponivel.PLetivo_Id = nvl( p_PLetivo_Id ,0)
and
 	ProfDisponivel.WPessoa_Id = nvl( p_WPessoa_Id ,0)  