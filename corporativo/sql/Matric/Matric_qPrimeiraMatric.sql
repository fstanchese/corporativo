select
  count(*) as total,
  currofe.pletivo_id 
from
  Matric,
  turmaofe,
  currofe  
where
  currofe.id=turmaofe.currofe_id
and
  matric.turmaofe_id=turmaofe.id
and
  Matric.State_Id > 3000000002001
and
  Matric.MatricTi_Id = 8300000000001
and
  Matric.WPessoa_Id = nvl ( p_WPessoa_Id , 0 )
group by currofe.pletivo_id
order by currofe.pletivo_id desc
