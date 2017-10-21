select
  matric.id                                                     as id,
  matric.data                                                   as data,
  matric.rematricula                                            as rematricula,
  curr.id                                                       as curr_id,
  duracxci.sequencia                                            as serie,
  duracxci.nome                                                 as serieNome,
  matric.matricTi_id                                            as matricTi_id,
  Pletivo.Nome||' - '||Turma_gsRecognize(Matric_gnRetTurma(Matric.Id))||' - '||TurmaOfe_gsRetCodSala(Matric.TurmaOfe_id)||' - '||matricti_gsrecognize(matric.matricti_id) ||' - '|| state_gsrecognize(matric.state_id)||' - '||shortname(Curr.CurrNomeHist,80) as recognize,
  currofe.id  as currofe_id,
  turmaofe.id as turmaofe_id,
  matric.state_id as state_id
from
  duracxci,
  turma,
  curr,
  currofe,
  turmaofe,
  matric, 
  PLetivo
where
  turma.duracxci_id = duracxci.id
and
  turmaofe.turma_id = turma.id
and
  currofe.curr_id = curr.id
and
  CurrOfe.PLetivo_Id = PLetivo.Id
and
  turmaofe.currofe_id = currofe.id
and
  matric.turmaofe_id = turmaofe.id
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
order by recognize
