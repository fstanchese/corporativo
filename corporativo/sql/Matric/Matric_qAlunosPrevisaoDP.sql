select
  WPessoa.Codigo,
  WPessoa.Nome,
  Decode(TempDpAdap.SimNao_Cursar_Id,6000000000001,'sim','nao') as cursar,
  nvl(wpessoa.foneres,wpessoa.fonecel) as telefone
from
  wpessoa,
  tempdpadap,
  curso,
  curr,
  currxdisc,
  matric,
  turmaofe,
  turma
where
  matric.id = tempdpadap.matric_id
and
  wpessoa.id = matric.wpessoa_id
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
  matric.state_id = 3000000002002
and
  (
    p_Curso_Id is null 
     or
    curso.id = nvl( p_Curso_Id ,0 )
  )
and
  turma.campus_id = nvl( p_Campus_Id ,0)
and 
  tempdpadap.gradaluti_id = nvl ( p_GradAluTi_Id , 0)
and
  tempdpadap.currxdisc_id = nvl ( p_CurrXDisc_Id , 0)
and
  tempdpadap.pletivo_id = nvl ( p_PLetivo_Id , 0)
order by 2