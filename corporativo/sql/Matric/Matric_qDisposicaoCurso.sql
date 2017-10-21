select
  curso.id    as id,
  curso.nome  as cursoNome
from
  curso
where
  curso.cursoNivel_id = 6200000000001
order by
  cursoNome