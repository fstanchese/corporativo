select
  matric.Id as Id,
  matric.wpessoa_id,
  matric.state_id,
  discesp.nomereduz,
  turmaofe.id as turmaofe_id
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
  wpessoa.id = nvl ( p_WPessoa_Id , 0 )
and
  discesp.pletivo_id = nvl( p_PLetivo_Id ,0)
