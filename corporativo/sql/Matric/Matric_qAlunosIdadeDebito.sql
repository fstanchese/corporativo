oDoc ( alunos com idade >= 50 e que tenham débito )

select
  wpessoa.nome,
  wpessoa.codigo,
  wpessoa_gnidade(wpessoa.id) as idade,
  boleto_gsemaberto(wpessoa.id) as debitos
from
  curr,
  currofe,
  turmaofe,
  matric,
  wpessoa
where 
  wpessoa_gnidade(wpessoa.id) >= 50
and
  boleto_gntemdebito(wpessoa.id) = 1
and
  matric.wpessoa_id = wpessoa.id
and
  matric.matricti_id = 8300000000001
and
  (
  matric.state_id = 3000000002002
  or
  matric.state_id = 3000000002003
  )
and
  matric.turmaofe_id = turmaofe.id
and
  curr.id = currofe.curr_id
and
  turmaofe.currofe_id = currofe.id
and
  currofe.curr_id = curr.id
and
  currofe.pletivo_id = nvl( p_PLetivo_Id ,0)
order by 1
