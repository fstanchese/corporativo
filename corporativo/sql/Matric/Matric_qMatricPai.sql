select
  Matric.*,
  state_gsrecognize(matric.state_id)           as Situacao,
  turmaofe_gsretcodturma(matric.turmaofe_id)   as Turma,
  TurmaOfe_gnRetCurso(Matric.TurmaOfe_Id)      as Curso_Id,
  TurmaOfe_gnRetCurr(Matric.TurmaOfe_Id)       as Curr_Id,
  TurmaOfe_gsRetCodCurr(Matric.TurmaOfe_Id)    as CurrCod,
  TurmaOfe_gnRetCurrOfe(Matric.TurmaOfe_Id)    as CurrOfe_Id,
  TurmaOfe_gnRetPLetivo(Matric.TurmaOfe_Id)    as PLetivo_Id,
  TurmaOfe_gsRetPLetivo(Matric.TurmaOfe_Id)    as PLetivo,
  Turma.Campus_Id                              as Campus_Id,
  TurmaOfe_gsRetCurso(Matric.TurmaOfe_Id)      as Curso_Nome,
  TurmaOfe_gnRetCursoNivel(Matric.TurmaOfe_Id) as CursoNivel_Id
from
  Turma,
  TurmaOfe,
  Matric
where
  Turma.Id = TurmaOfe.Turma_Id
and
  TurmaOfe.Id = Matric.TurmaOfe_Id
and
  Matric.Matric_Pai_Id = nvl( p_Matric_Pai_Id ,0) 
order by data
