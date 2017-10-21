
select
  matric.id                                                     as id,
  matric.data                                                   as data,
  matric.rematricula                                            as rematricula,
  curr.id                                                       as curr_id,
  duracxci.sequencia                                            as serie,
  duracxci.nome                                                 as serieNome,
  matric.matricTi_id                                            as matricTi_id,
  matric_gsrecognize(matric.id)                                 as recognize,
  DuracXCi_gnRetSequencia(TurmaOfe_gnDuracXCi(TurmaOfe.Id))     as DuracXCi_Sequencia,
  Turma_gsRecognize(Matric_gnRetTurma(Matric.Id))               as Turma_Recognize,
  State_gsRecognize(Matric.State_Id)                            as Situacao,
  Matric.State_Id                                               as State_Id
from
  duracxci,
  turma,
  curr,
  currofe,
  turmaofe,
  matric
where
  turma.duracxci_id = duracxci.id
and
  turmaofe.turma_id = turma.id
and
  currofe.curr_id = curr.id
and
  turmaofe.currofe_id = currofe.id
and
  matric.turmaofe_id = turmaofe.id
and
  matric.state_id > 3000000002001
and
  ( 
    p_MatricTi_Id is null
     or
    matric.matricTi_id = nvl( p_MatricTi_Id ,0)
  )
and
  ( 
    p_Curso_Id is null
     or
    curr.Curso_Id = nvl( p_Curso_Id ,0)
  )
and
  ( 
    p_PLetivo_Id is null
     or
    currofe.Pletivo_Id = nvl( p_PLetivo_Id ,0)
  )
and
  matric.wpessoa_id = nvl( p_WPessoa_Id ,0)
