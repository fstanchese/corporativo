select
  Estado.Preposicao as Preposicao,
  Estado.Nome  as Estado_Nome,
  Estado.Sigla as Estado_Sigla,
  Cidade.*,
  Upper(Cidade.Nome)||' - '||Upper(Estado.Sigla) as Natural,
  Estado.CodCenso as UFCenso
from
  Cidade,
  Estado
where
  Estado.Id = Cidade.Estado_Id
and
  Cidade.Id = nvl( p_Cidade_Id ,0)