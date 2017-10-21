select
  Pagto.Id    as Id,
  Pagto.Nome  as Recognize 
from
  Pagto
where
  Pagto.Us = p_Pagto_Us 
order by
  Pagto.Nome