select
  turma.id,
  turma.codigo
from
  turma
where
  turma.codigo = Upper('$v_search')