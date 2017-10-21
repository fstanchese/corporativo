select
  Pletivo.Nome as ano
from
  duracxci,
  turma,
  curr,
  currofe,
  turmaofe,
  matric, 
  PLetivo
where
  matric.state_id > 3000000002001
and
  turma.duracxci_id = duracxci.id
and
  turmaofe.turma_id = turma.id
and
  currofe.curr_id = curr.id
and
  CurrOfe.PLetivo_Id = PLetivo.Id
and
  turmaofe.currofe_id = currofe.id
and
  matric.turmaofe_id = turmaofe.id
and
  matric.matricTi_id = 8300000000001
and
  curr.curso_id = nvl ( p_Curso_Id , 0 )
and
  matric.wpessoa_id = nvl( p_WPessoa_Id  ,0 )
group by pletivo.nome
order by pletivo.nome