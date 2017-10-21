select
  count(matric.id)                      as ALUNOS,
  curr.curso_id                         as Curso_Id,
  Curso_gsRetNome(curr.curso_id)        as CursoNome,
  Periodo.Nome                          as Periodo,
  Periodo.Id                            as Periodo_Id,
  Campus_gsRecognize(currofe.campus_id) as CampusNome,
  currofe.campus_id                     as Campus_Id
from
  curr,
  currofe,
  turmaofe,
  matric,
  VestCla,
  Turma,
  Periodo
where 
  Turma.Periodo_id = Periodo.Id
and
  TurmaOfe.Turma_Id = Turma.Id
and
  Matric.Id = VestCla.Matric_Id
and
  Matric.State_Id = 3000000002002
and
  matric.matricti_id = 8300000000001
and
  matric.turmaofe_id = turmaofe.id
and
  turmaofe.currofe_id = currofe.id
and
  currofe.curr_id = curr.id
and
  currofe.pletivo_id = nvl( p_PLetivo_Id ,0)
group by currofe.campus_id, curr.curso_id, Periodo.Nome, Periodo.Id
order by CampusNome, CursoNome, Periodo