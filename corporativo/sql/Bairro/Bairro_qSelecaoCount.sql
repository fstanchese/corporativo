select
  count(Bairro.Id) as count
from
  Bairro,
  Cidade
where
  Estado_Id = 1200000000001
and
  Cidade.Id = Bairro.Cidade_Id
and
  Bairro.us <> 'ALUNOS'
and
  upper(Bairro.nome) like '%'||replace( trim( upper( p_Bairro_Nome ) ),' ','%')||'%'
and
  p_Bairro_Nome is not null