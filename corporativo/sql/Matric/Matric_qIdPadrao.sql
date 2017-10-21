select
  Matric.*,
  state_gsrecognize(matric.state_id)           as Situacao,
  turmaofe_gsretcodturma(matric.turmaofe_id)   as Turma,
  wpessoa_gsRecognize(matric.wpessoa_id)       as NomeAluno,
  WPessoa.Codigo                               as RA,
  TurmaOfe_gnRetCurso(Matric.TurmaOfe_Id)      as Curso_Id,
  TurmaOfe_gnRetCurr(Matric.TurmaOfe_Id)       as Curr_Id,
  TurmaOfe_gsRetCodCurr(Matric.TurmaOfe_Id)    as CurrCod,
  TurmaOfe_gnRetCurrOfe(Matric.TurmaOfe_Id)    as CurrOfe_Id,
  TurmaOfe_gnRetPLetivo(Matric.TurmaOfe_Id)    as PLetivo_Id,
  TurmaOfe_gsRetPLetivo(Matric.TurmaOfe_Id)    as PLetivo,
  Turma.Campus_Id                              as Campus_Id,
  Campus_gsRecognize(Turma.Campus_Id)          as Campus_Recognize,
  TurmaOfe_gsRetCurso(Matric.TurmaOfe_Id)      as Curso_Nome,
  TurmaOfe_gnRetCursoNivel(Matric.TurmaOfe_Id) as CursoNivel_Id
from
  Turma,
  TurmaOfe,
  Matric,
  WPessoa
where
  Turma.Id = TurmaOfe.Turma_Id
and
  TurmaOfe.Id = Matric.TurmaOfe_Id
and
  Matric.WPessoa_Id = WPessoa.Id
and
  Matric.id = nvl( p_Matric_Id ,0) 
