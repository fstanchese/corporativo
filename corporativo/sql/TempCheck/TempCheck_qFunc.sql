select
  distinct wpessoa.id as ID,
  wpessoa.nome as recognize
from
  WPessoa, WPesXDepart, wpacampus, admissao
where
  wpessoa.id = WPesXDepart.wpessoa_id
and
  wpessoa.id = admissao.wpessoa_id
and
  admissao.demissao is null
and
  wpesxdepart.depart_id = 36000000000028
and
  teste_cpd is null
and
  campus_id = 6400000000001
and
  wpessoa.id = wpacampus.wpessoa_id

and
  wpesxdepart.dttermino is null
order by recognize
