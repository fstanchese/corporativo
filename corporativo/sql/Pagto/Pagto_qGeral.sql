
select
  Pagto.*,
  Pagto.Id,
  Pagto.Nome as Recognize
from
  Pagto
order by Pagto.Nome