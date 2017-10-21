select * from (
select
  curso.nome as curso,
  turma.codigo as turma,
  disc.codigo as disc,
  divturma_gsrecognize(alocaprof.divturma_id) as divisao, 
  to_char(alocaprofhi.dt,'dd/mm/yyyy HH24:MI') as data,
  professor_gsrecognize(to_number(old)) as anterior,
  professor_gsrecognize(to_number(new)) as atual,
  1 as indexador
from
  disc,
  curso,
  curr, 
  currxdisc,
  turma,
  alocaprof,
  alocaprofhi
where
  curr.curso_id=curso.id
and
  currxdisc.curr_id=curr.id
and
  alocaprof.id=alocaprofhi.alocaprof_id
and
  upper(col) like 'PROFESSOR%'
and
  alocaprof.turma_id=turma.id
and
  alocaprof.currxdisc_id=currxdisc.id
and
  currxdisc.disc_id=disc.id
and
  ( p_Curso_Id is null or curso.id=nvl( p_Curso_Id , 0 ) )
and
  alocaprof.pletivo_id = nvl( p_PLetivo_Id , 0 ) 
and
  (alocaprofhi.us='PROF_DEISE07' or alocaprofhi.us='PROF_BONTEMPO')
and
  trunc(alocaprofhi.dt)='24/02/2014'
group by curso.nome,turma.codigo,divturma_id,alocaprofhi.dt,disc.codigo,old,new
union all
select
  curso.nome as curso,
  turma.codigo as turma,
  disc.codigo as disc,
  divturma_gsrecognize(alocaprof.divturma_id) as divisao,
  to_char(alocxhorhi.dt,'dd/mm/yyyy HH24:MI') as data,
  horario_gsrecognize(to_number(old)) as anterior,
  horario_gsrecognize(to_number(new)) as atual,
  1 as indexador
from
  disc,
  curso,
  curr,
  currxdisc,
  turma,
  alocaprof,
  alocxhor,
  alocxhorhi
where
  curr.curso_id=curso.id
and
  currxdisc.curr_id=curr.id
and
  upper(col) like 'HORARIO%'
and
  alocxhor.id=alocxhorhi.alocxhor_id
and
  alocxhor.alocaprof_id=alocaprof.id
and
  alocaprof.turma_id=turma.id
and
  alocaprof.currxdisc_id=currxdisc.id
and
  currxdisc.disc_id=disc.id
and
  ( p_Curso_Id is null or curso.id=nvl( p_Curso_Id , 0 ) )
and
  alocaprof.pletivo_id = nvl( p_PLetivo_Id , 0 )
and
  (alocxhorhi.us='PROF_DEISE07' or alocxhorhi.us='PROF_BONTEMPO')
and
  trunc(alocxhorhi.dt)='24/02/2014'
group by curso.nome,turma.codigo,divturma_id,alocxhorhi.dt,disc.codigo,old,new
) order by 1,5,8,3,2
