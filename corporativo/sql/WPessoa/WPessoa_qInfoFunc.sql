SELECT
	wpessoa.id,
	wpessoa.nome,
	codigofunc,
	cpf,
	usuario,
	depart.nomereduz as depart
	
FROM
	wpessoa, depart
WHERE 
	wpessoa.depart_id = depart.id
	and
	wpessoa.id = p_WPessoa_Id
	
and funcionario = 'on'
	