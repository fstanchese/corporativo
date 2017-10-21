select
  Bairro.Id,
  Bairro.Nome,
  Bairro_gsRecognize(Bairro.Id)                      as Recognize,
  shortname(Cidade_gsRecognize(Bairro.Cidade_Id),30) as Cidade  
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
order by
  Cidade, Bairro.nome
