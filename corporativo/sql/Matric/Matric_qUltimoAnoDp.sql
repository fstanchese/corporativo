select count(*) as total
from (
select 
  tempdpadap.wpessoa_id,
  tempdpadap.gradaluti_id,  
  turmaofe_gnultimoanista(turmaofe.id) as ultimoano  
from
  tempdpadap,
  currxdisc,
  matric,
  turmaofe,
  currofe,
  curr
where
  (
    p_Campus_Id is null
    or
    currofe.campus_id=nvl( p_Campus_Id , 0 )
  )
and
  currofe.periodo_id=nvl( p_Periodo_Id , 0 )
and
  turmaofe.currofe_id=currofe.id
and
  matric.turmaofe_id=turmaofe.id
and
  tempdpadap.matric_id=matric.id
and
  ( 
    p_Matric_State_Id is null
    or
    Matric.State_Id = nvl ( p_Matric_State_Id , 0 )
  )
and
  curr.curso_id=nvl ( p_Curso_Id , 0 )
and
  curr.id=currxdisc.curr_id
and
  currxdisc.id=tempdpadap.currxdisc_id
and
  tempdpadap.gradaluti_id = nvl ( p_GradAluTi_Id , 0 )
and
  tempdpadap.pletivo_id = nvl ( p_PLetivo_Id , 0 )
) where ultimoano=1
group by wpessoa_id,gradaluti_id

