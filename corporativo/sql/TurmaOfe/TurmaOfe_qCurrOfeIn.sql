select 
  turmaofe.id                                                             as id,
  turmaofe.id                                                             as turmaofe_id,
  turma_id                                                                as turma_id,
  turma_gsrecognize(turma_id)                                             as turma_recognize,
  turmaofe_gsrecognize(turmaofe.id) || ' - ' || Matric_gnQtdeEstudando(TurmaOfe.Id, p_O_Data , p_O_Numero ) || ' - (' || Sala.QtdMaxAlun || ')' as recognize,
  duracxci_gnRetSequencia(turma.duracxci_id)                              as sequencia,
  QtdMaxAlun                                                              as QtdeSala
from
  turma,
  turmaofe,
  sala,
  DuracXCi
where 
  (
    DuracXCi.Sequencia = p_DuracXCi_Sequencia
  or
    p_DuracXCi_Sequencia is null
  )
and
  Turma.DuracXCi_Id = DuracXCi.Id (+)
and
  turmaofe.sala_id = sala.id (+)
and
  turmaofe.turma_id = turma.id
and
  turmaofe.currofe_id = nvl( p_CurrOfe_Id ,0)
order by
  4