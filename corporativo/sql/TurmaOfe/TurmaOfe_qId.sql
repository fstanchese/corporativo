select  
  TurmaOfe.*,
  Turma.TurmaTi_Id,
  Turma_gsRecognize(TurmaOfe.Turma_Id) as Turma,
  Sala_gsRecognize(TurmaOfe.Sala_Id)   as Sala,
  Decode(Turma.Periodo_Id,6500000000001,'1;0;0','0;0;1') as PerEnade,
  Decode(Turma.Periodo_Id,6500000000001,'1','3') as PerCenso,
  TurmaOfe_gnRetCurr(TurmaOfe.Id) as Curr_Id,
  Turma.Curso_Id,
  DuracXCi.Sequencia,
  WPessoa_gsRecognize(TurmaOfe.WPessoa_Rep_Id)  as Representante,
  WPessoa_gsRecognize(TurmaOfe.WPessoa_Sup1_Id) as Suplente_1,
  WPessoa_gsRecognize(TurmaOfe.WPessoa_Sup2_Id) as Suplente_2,
  Campus_gsrecognize(Turma.Campus_Id) as Campus,
  Turma.Campus_Id as Campus_Id,
  Turma.Periodo_Id as Periodo_Id,
  Turmaofe_gnultimoanista(TurmaOfe.Id) as UltimoAno,
  TurmaOfe_gnRetPletivo(TurmaOfe.Id) as PLetivo_Id,
  Turma.CodInep as CodINEP
from  
  DuracXCi,
  Turmaofe,
  Turma  
where  
  DuracXCi.Id (+) = Turma.DuracXCi_Id
and
  Turma.Id = TurmaOfe.Turma_Id
and
  TurmaOfe.id = nvl( p_TurmaOfe_Id ,0) 
