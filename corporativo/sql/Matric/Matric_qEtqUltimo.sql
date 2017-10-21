select * from (
select
  wpessoa.id,
  lograd.nome || ' ' || wpessoa.endernum as endereco,
  wpessoa.nome as pessoa,
  bairro.nome as bairro,
  cidade.nome as cidade,
  estado.sigla as estado,
  lograd.cep,
  wpessoa.codigo as ra,
  turmaofe_gnultimoanista(matric.turmaofe_id) as ultimoano
from
  wpessoa,
  matric,
  turmaofe,
  currofe,
  pletivo,
  lograd,
  bairro,
  cidade,
  estado,
  curr
where
  wpessoa.lograd_id = lograd.id
and
  lograd.bairro_id = bairro.id
and
  bairro.cidade_id = cidade.id
and
  cidade.estado_id = estado.id
and
  cep is not null
and
  (
   p_Curso_Id is null
   or
   curr.curso_id = nvl ( p_Curso_Id , 0 )
  )
and
  (
   p_TurmaOfe_Id is null
    or  
   turmaofe.id = nvl ( p_TurmaOfe_Id , 0 )
  )
and
  matric.wpessoa_id=wpessoa.id
and
  matric.turmaofe_id=turmaofe.id
and
  turmaofe.currofe_id=currofe.id
and
  currofe.pletivo_id=pletivo.id
and
  currofe.curr_id = curr.id
and
  matric.matricti_id=8300000000001
and
  matric.state_id in  ( 3000000002002,3000000002010,3000000002011,3000000002012 )
and
  ( pletivo.id = nvl ( p_PLetivo_Id , 0 ) or p_PLetivo_Id is null )
order by cep
) where ultimoano = nvl ( p_UltimoAno , 1 )

