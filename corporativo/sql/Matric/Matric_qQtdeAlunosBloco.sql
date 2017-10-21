select
  count(Matric.Id)                      as Qtde,
  Bloco_gsRecognize(Sala.Bloco_Id)      as Bloco_Recognize,
  Periodo_gsRecognize(Turma.Periodo_Id) as Periodo_Recognize,
  Andar_gsRecognize(Sala.Andar_Id)      as Andar_Recognize 
from
  Turma,
  TurmaOfe,
  Currofe,
  Sala,
  Matric
where
  (
    Turma.Periodo_Id = p_Periodo_Id 
  or
    p_Periodo_Id is null
  )
and
  Turma.Campus_Id = p_Campus_Id
and
  Matric.State_Id in (3000000002002,3000000002003,3000000002010,3000000002011,3000000002014)
and
  Turma.Id = TurmaOfe.Turma_Id
and
  TurmaOfe.Sala_Id = Sala.Id
and
  MatricTi_Id = 8300000000001
and
  Matric.TurmaOfe_Id = TurmaOfe.Id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  CurrOfe.PLetivo_Id = p_PLetivo_Id 
group by Sala.Bloco_Id, Turma.Periodo_Id, Andar_Id 
order by Turma.Periodo_Id, Bloco_Id, Andar_Id 
