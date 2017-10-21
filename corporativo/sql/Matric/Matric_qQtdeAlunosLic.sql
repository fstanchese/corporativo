select 
  count(qtde) as totalalunos,
  sum(qtde)   as totaldiscip 
from (
select
  count(matric.wpessoa_id) as qtde
from
  matric,
  turmaofe,
  wpessoa,
  discesp
where
  Matric.MatricTi_Id = 8300000000002
and
  ( 
    ( 
      Matric.State_Id in ( 3000000002002,3000000002003,3000000002010,3000000002011,3000000002012 )
      and
      trunc(Matric.Data) < nvl( p_O_Data1 , trunc(sysdate) )
    )
    or
    (
      Matric.State_Id in ( 3000000002004,3000000002005,3000000002006,3000000002007,3000000002008,3000000002009 ) 
      and 
      trunc(Matric.DtState) >= nvl( p_O_Data1 , trunc(sysdate) ) 
    ) 
  )
and
  wpessoa.id = matric.wpessoa_id
and
  turmaofe.id = matric.turmaofe_id
and
  discesp.id = turmaofe.discesp_id
and
  discesp.discespti_id = 17800000000003
and
  discesp.pletivo_id = nvl( p_PLetivo_Id ,0)
group by matric.wpessoa_id
)

