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
  currofe,
  curr,
  curso,
  pletivo
where
  Matric.MatricTi_Id = 8300000000001
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
  curso.cursonivel_id=6200000000002
and
  curr.curso_id=curso.id
and
  currofe.curr_id=curr.id
and
  turmaofe.id = matric.turmaofe_id
and
  (
    p_Campus_Id is null
    or
    CurrOfe.Campus_Id = nvl ( p_Campus_Id ,0)
  )
and
  turmaofe.currofe_id=currofe.id
and
  currofe.pletivo_id = pletivo.id
and
  pletivo.ano_id = nvl ( p_Ano_Id , 0 )
group by matric.wpessoa_id
)

