//Query apenas com usuários de funcionários e professores ativos 

select
  WPessoa.Id as COD_USUARIO_EXT,
  WPessoa.Nome as NOM_USUARIO,
  WPessoa.usuario as LOGIN_USUARIO,
  WPessoa.senha as SENHA_USUARIO,
  WPessoa.cpf  as CPF_USUARIO,
  WPessoa.email1 as EML_USUARIO
FROM
  WPESSOA,
  admissao  
WHERE
  wpessoa.id = admissao.wpessoa_id
and
  admissao.demissao is null
and
  WPessoa.usuario is not null
and
  ( WPessoa.funcionario = 'on' or WPessoa.docente = 'on' )
order by 2


//Query com todos os usuários de funcionários e professores (incluindo os demitidos)
select
  Id as COD_USUARIO_EXT,
  Nome as NOM_USUARIO,
  usuario as LOGIN_USUARIO,
  senha as SENHA_USUARIO,
  cpf  as CPF_USUARIO,
  email1 as EML_USUARIO
FROM
  WPESSOA
WHERE
  usuario is not null
and
  ( funcionario = 'on' or docente = 'on' )
order by 2