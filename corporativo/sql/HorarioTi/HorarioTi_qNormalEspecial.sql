
select
  horarioTi.id,
  horarioTi.nome as recognize
from
  horarioTi
where
  id <= 12800000000002
order by
  horarioTi.id