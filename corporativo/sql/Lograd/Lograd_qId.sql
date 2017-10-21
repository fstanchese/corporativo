select
  Lograd.Id                                                                as Lograd_Id,
  Lograd.Nome                                                              as Logradouro,
  Lograd.CEP                                                               as CEP,
  Bairro.Nome                                                              as Bairro,
  Cidade.Nome                                                              as Cidade,
  Estado.Sigla                                                             as SiglaEstado,
  Estado.Nome                                                              as Estado,
  to_char(substr(Lograd.CEP,1,5),'00000') || '-' || substr(Lograd.CEP,6,3) as CEP_F,
  Bairro.Id                                                                as Bairro_Id,
  Bairro.Cidade_Id                                                         as Cidade_Id,
  Lograd_gsRecognize(Lograd.Id)                                            as Recognize
from
  Lograd,
  Bairro,
  Cidade,
  Estado
where
  Lograd.Bairro_Id = Bairro.Id
and
  Bairro.Cidade_Id = Cidade.Id
and
  Cidade.Estado_Id = Estado.id
and 
  Lograd.Id = nvl( p_Lograd_Id ,0)