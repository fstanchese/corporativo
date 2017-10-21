select
  wpessoa.id,
  lograd.nome || ' ' || wpessoa.endernum as endereco,
  wpessoa.nome as pessoa,
  bairro.nome as bairro,
  cidade.nome as cidade,
  estado.sigla as estado,
  lograd.cep,
  wpessoa.codigo as ra
from
  wpessoa,
  matric,
  turmaofe,
  currofe,
  curr,
  curso,
  pletivo,
  lograd,
  bairro,
  cidade,
  estado
where
  matric.matricti_id=8300000000001
and
  curso.cursonivel_id=6200000000002
and
  curr.curso_id=curso.id
and
  currofe.curr_id=curr.id
and
  matric.state_id=3000000002002
and
  matric.wpessoa_id=wpessoa.id
and
  matric.turmaofe_id=turmaofe.id
and
  turmaofe.currofe_id=currofe.id
and
  currofe.pletivo_id=pletivo.id
and
  pletivo.id in ( p_PLetivo_Id )
and
  wpessoa.lograd_id = lograd.id
and
 lograd.bairro_id = bairro.id
and
  bairro.cidade_id = cidade.id
and
 cidade.estado_id = estado.id
and
 cep is not null
group by wpessoa.id, lograd.nome || ' ' || wpessoa.endernum, wpessoa.nome, bairro.nome, cidade.nome, estado.sigla, lograd.cep, wpessoa.codigo
order by cep
