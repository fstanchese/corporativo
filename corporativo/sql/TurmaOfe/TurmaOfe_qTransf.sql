select 
  TurmaOfe.Id as Id,
  Turma.Id as Turma_Id,
  Turma_gsRecognize(Turma.Id) as Turma_Recognize,
  turmaofe_gsrecognize(turmaofe.id) || ' - ' ||Campus.Nome||' - '||Matric_gnQtdeEstudando(TurmaOfe.Id, p_O_Data , p_O_Numero ) || ' - (' || Sala.QtdMaxAlun || ')' as recognize
from
  Sala,
  DuracXCi,
  campus,
  Turma,
  TurmaOfe,
  CurrOfe,
  Curr
where
  turma.campus_id=campus.id
and
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
  CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0) 
and
  Curr.Id = nvl( p_Curr_Id ,0)
order by 3
