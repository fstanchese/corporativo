select
  matric.id                                 as id,
  wpessoa.codigo                            as codigo,
  Upper (wpessoa.nome)                      as nome,
  Upper (curso.nome)                        as curso,
  Pletivo.Nome||' - '||shortname(Curr.CurrNomeHist,80) || decode(Curr.CurrNivelDesc,null,Curr.CurrNivelDesc,' - ' || Curr.CurrNivelDesc) as recognize,
  PLetivo.Nome||duracxci.nome||decode(matric.matricti_id,8300000000001,8300000000002,8300000000002,8300000000001)||Curr.Codigo as linha,
  to_char (turma.id-6700000000000, '00000') as turmaSequencia,
  nvl(matric.data,trunc(sysdate))           as datax,
  matric.state_id                           as state_id,
  state_gsrecognize(matric.state_id)        as Situacao,
  sexo_gsRecognize(WPessoa.Sexo_Id)         as Sexo_Recognize,
  curso.id                                  as curso_id,
  turmaofe_gnretperiodo(matric.turmaofe_id) as Periodo_Id,
  turmaofe_gsretcodturma(turmaofe_id)       as turma,
  turmaofe_gsretpletivo(matric.turmaofe_id) as pletivo,
  PLetivo.Id                                as PLetivo_Id,
  turmaofe.id                               as turmaofe_id,
  Turma.Campus_Id                           as Campus_Id,
  DuracXCi.Sequencia                        as Serie,
  Curso.Nome                                as Curso_Nome
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
  wpessoa.id = matric.wpessoa_id
and
  Matric.MatricTi_Id = 8300000000001 
and
  ( TurmaOfe_gnUltimoAnista( Matric.TurmaOfe_Id ) = 1 or curr.id in ( 5800000001170 , 5800000000296 , 5800000000748 ) )
and
  Matric.State_Id = 3000000002012 
and
  matric.wpessoa_id = nvl( p_WPessoa_Id ,0)
order by linha desc