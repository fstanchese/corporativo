select
  count(*) as total
from
  tempdpadap,
  curso,
  curr,
  currxdisc,
  matric,
  turmaofe,
  turma
where
  turma.campus_id = nvl( p_Campus_Id ,0)
and
  turmaofe.turma_id = turma.id  
and
  matric.TURMAOFE_ID = turmaofe.id
and
  tempdpadap.matric_id = matric.id
and
  curso.id=curr.curso_id
and
  curr.id=currxdisc.curr_id
and
  tempdpadap.currxdisc_id=currxdisc.id
and
  tempdpadap.pletivo_id = nvl ( p_PLetivo_Id , 0)
and
  ( 
    p_SimNao_Cursar_Id is null
      or
    tempdpadap.simnao_cursar_id = nvl ( p_SimNao_Cursar_Id , 0)
  )
and
  (
     p_GradAluTi_Id is null
      or
     tempdpadap.gradaluti_id = nvl ( p_GradAluTi_Id , 0)
  )
and
  (
    p_Curso_Id is null 
     or
    curso.id = nvl( p_Curso_Id ,0 )
  )
and
  tempdpadap.currxdisc_id = nvl ( p_CurrXDisc_Id , 0)
