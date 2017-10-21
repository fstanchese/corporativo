select
  WPessoa.Nome as NOME
from
  currofe,
  turmaofe,
  matric,
  wpessoa
where
  turmaofe.currofe_id = currofe.id
and
  currofe.pletivo_id = 7200000000036
and
  matric.state_id = 3000000002003
and
  matric.turmaofe_id = turmaofe.id
and
  matric.matricTi_id = 8300000000001
and
  wpessoa.id = matric.wpessoa_id
order by
  WPessoa.Nome
