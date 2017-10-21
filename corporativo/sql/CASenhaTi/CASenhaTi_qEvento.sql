select 
  CASenhaTi.Id as Id,
  CASenhaTi.Descricao as Recognize
from
  CASenhaTi,
  CAAssunto
where
  CASenhaTi.CAAssunto_Id = CAAssunto.Id
and
  CAAssunto.CAEvento_Id = p_CAEvento_Id
order by Recognize