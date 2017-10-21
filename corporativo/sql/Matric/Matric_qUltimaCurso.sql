select
  Matric.Id                       as Id,
  Curr.Id                         as Curr_Id, 
  PLetivo.Id                      as PLetivo_Id,
  DuracXCi.Sequencia              as Serie,
  Matric.State_Id                 as State_Id,
  nvl(Matric.Data,PLetivo.Inicio) as DataX,
  CurrOfe.Id                      as CurrOfe_Id,
  PLetivo.Nome                    as PLetivoNome,
  Curso.Id                        as Curso_Id,
  Turma.Codigo                    as CodigoTurma,
  State_gsRecognize(Matric.State_Id) as StateNome,
  Curr.Codigo                     as CodigoCurr,
  Matric.DtState                  as DtState,
  CurrOfe.Periodo_Id              as Periodo_Id,
  Curso.Nome                      as Curso_Nome
from
  pletivo,
  duracxci,
  turma,
  curr,
  curso,
  currofe,
  turmaofe,
  matric,
  wpessoa
where
  ( matric.state_id <> 3000000002013 and matric.state_id <> 3000000002009 )
and
  matric.state_id > p_Matric_State_Id
and
  pletivo.id < p_PLetivo_Limite_Id
and
  currofe.pletivo_id = pletivo.id
and
  turma.duracxci_id = duracxci.id (+)
and
  turmaofe.turma_id = turma.id
and
  curr.curso_id = curso.id
and
  currofe.curr_id = curr.id
and
  turmaofe.currofe_id = currofe.id
and
  matric.turmaofe_id = turmaofe.id
and
  matric.matricTi_id = 8300000000001
and
  wpessoa.id = matric.wpessoa_id
and
  matric.wpessoa_id = nvl( p_WPessoa_Id ,0)
and
  Curso.Id = nvl( p_Curso_Id ,0)
order by
  DataX