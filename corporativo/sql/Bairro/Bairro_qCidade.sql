select
  Bairro.Id,
  Bairro.Nome,
  Cidade.Id,
  Cidade.Nome
from
  Bairro,
  Cidade
where
  Bairro.Cidade_Id = Cidade.Id
and
  (
  	Bairro.Cidade_Id = p_Bairro_Cidade_Id
  or
  	p_Bairro_Cidade_Id is null
  )
order by Bairro.Nome 