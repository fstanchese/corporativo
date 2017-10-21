select
  matric.wpessoa_id,
  wpessoa.codigo as ra,
  wpessoa.nome
from
  matric,
  turmaofe,
  wpessoa,
  discesp
where
  wpessoa.id = matric.wpessoa_id
and
  turmaofe.id = matric.turmaofe_id
and
  discesp.id = turmaofe.discesp_id
and
  discesp.discespti_id = 17800000000003
and
  discesp.pletivo_id = nvl( p_PLetivo_Id ,0)
group by matric.wpessoa_id,wpessoa.codigo,wpessoa.nome
order by 3

