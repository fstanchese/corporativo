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
  wpesxdepart.depart_id = p_Depart_Id
and
  teste_cpd is null
and
  wpessoa.id = wpacampus.wpessoa_id
and
  wpacampus.campus_id = $_SESSION[campus_id]
and
  wpesxdepart.dttermino is null
order by recognize

