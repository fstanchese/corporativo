select
  curso.nome                                        as nomecurso,
  substr(currxdisc_gsretcodcurr(currxdisc_id),1,10) as codcurr,
  substr(currxdisc_gsretcoddisc(currxdisc_id),1,10) as coddisc,
  substr(currxdisc_gsretserie(currxdisc_id),1,10)   as serie,
  substr(currxdisc_gsretdisc(currxdisc_id),1,70)    as nomdisc,
  currxdisc_id
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
  tempdpadap.simnao_cursar_id is not null
and
  tempdpadap.pletivo_id = nvl ( p_PLetivo_Id , 0)
and
  (
    p_Curso_Id is null 
     or
    curso.id = nvl( p_Curso_Id ,0 )
  )
group by tempdpadap.currxdisc_id,curso.nome
order by 1,4,3,2