select
  Id,
  Nome as Recognize,
  Capital
from
  Cidade
where
  p_Cidade_Nome is not null
and
  Nome like p_Cidade_Nome ||'%'
and
  Estado_Id = nvl(  p_Estado_Id ,0)
order by
  Nome 