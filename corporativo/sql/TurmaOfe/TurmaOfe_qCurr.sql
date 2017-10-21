select 
  Turma.Id as Id,
  Turma.Id as Turma_Id,
  Turma_gsRecognize(Turma.Id) as Turma_Recognize,
  turmaofe_gsrecognize(turmaofe.id) || ' - ' || Matric_gnQtdeEstudando(TurmaOfe.Id, p_O_Data , p_O_Numero ) || ' - (' || Sala.QtdMaxAlun || ')' as recognize,
from
  Sala,
  DuracXCi,
  Turma,
  TurmaOfe,
  CurrOfe,
  Curr
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
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  CurrOfe.Curr_Id = Curr.Id
and
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Replicar_Id ,0) 
and
  Curr.Curso_Id = nvl( p_Curso_Id ,0)
order by 3
