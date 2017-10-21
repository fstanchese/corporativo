select
  Lograd.Id,
  Lograd.Nome,
  Lograd.cep,
  Lograd_gsRecognize(Lograd.Id)                      as Recognize,
  shortname(Bairro.Nome,30)                          as Bairro,
  shortname(Cidade_gsRecognize(Bairro.Cidade_Id),30) as Cidade  
from
  Lograd,
  Bairro
where
  Lograd.us <> 'ALUNOS'
and
  Lograd.Bairro_Id = Bairro.Id
and
(
  ( 
    cep = p_Lograd_CEP
  and
    p_Lograd_CEP is not null
  )
or
  (
  upper(Lograd.nome) like '%'||replace( trim( upper( p_Lograd_Nome ) ),' ','%')||'%'
  and
  p_Lograd_Nome is not null
  ) 
)
order by
  Lograd.nome, Cidade,Bairro 