SELECT
	id,
	nome,
	codigo,
	cpf,
	'Sistemas de Informação' as Curso,
	'1ABCD' as Turma,
	'Matriculado' AS matricula
FROM
	wpessoa
WHERE 
	( id = p_WPessoa_Id and p_WPessoa_Id is not null ) or (codigo = p_WPessoa_Codigo and p_WPessoa_Codigo is not null )

and codigo is not null
	