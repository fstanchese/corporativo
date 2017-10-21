SELECT
	wpessoa.id,
	wpessoa.nome,
	codigofunc,
	cpf,
	class.nome as class,
	regtrab.nome as regtrab,
	usuario
	
FROM
	wpessoa, regtrab, class
WHERE 
	regtrab.id = wpessoa.regtrab_id
	and
	class.id = wpessoa.class_id
	and
	wpessoa.id = p_WPessoa_Id
	
and docente = 'on'
	