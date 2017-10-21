select
  Matric.*,
  Turma.Codigo as Turma,
  PLetivo.Nome as Periodo,
  State_gsRecognize(Matric.State_Id) as Situacao,
  upper(Matric.Us) as Usuario,
  Matric.State_Id as State_Id,
  Matric.Id as Matric_Id,
  Matric_gsRecognize(Matric.Id) as Recognize,
  to_date(Matric.Dt,'DD/MM/YYYY') as Dt,
  to_date(sysdate,'DD/MM/YYYY') as Data      
from 
  PLetivo,
  CurrOfe,
  Turma,
  TurmaOfe,
  Matric
where
  PLetivo.Id = CurrOfe.PLetivo_Id
and
  CurrOfe.Id = TurmaOfe.CurrOfe_Id
and
  Turma.Id = TurmaOfe.Turma_id
and
  TurmaOfe.Id = Matric.TurmaOfe_Id
and
  Matric.CriProm_Id = 870000000003
and
  Matric.WPessoa_Id = nvl( p_WPessoa_Id ,0)
order by
  Matric.Data
