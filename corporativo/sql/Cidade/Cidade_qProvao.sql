select
  Cidade.CodCenso as Id,
  Cidade.Nome     as Recognize
from
  Cidade,
  Estado
where
  Estado.CodCenso = p_AlunoCenso_UFNascimento
and
  Estado.Id = Cidade.Estado_Id 
and
  Cidade.CodCenso is not null
order by Cidade.Nome