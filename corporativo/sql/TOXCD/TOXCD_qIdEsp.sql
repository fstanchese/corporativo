select
  TOXCD.*,
  DiscEsp.NomeReduz                         as Disc,
  DiscEsp.Nome                              as NomeDisc, 
  DiscEsp.Id                                as DiscEsp_Id,
  Turma.Codigo                              as Turma,
  TurmaOfe_gsRecognize(TOXCD.TurmaOfe_Id)   as Recognize,
  AreaAcad_gsRecognize(DiscEsp.AreaAcad_Id) as Facul,
  DiscEsp.ChAnual                           as ChAnual,
  WPessoa_gsRecognize(WPessoa_ProfResp_Id)  as ProfResp,
  DiscEsp.AreaAcad_Id                       as AreaAcad_Id,
  Sala_gsRecognize(TurmaOfe.Sala_Id)        as Sala  
from
  Turma,
  TurmaOfe,
  DiscEsp,
  TOXCD
where
  Turma.Id = TurmaOfe.Turma_Id
and
  TurmaOfe.DiscEsp_Id = DiscEsp.Id
and
  TurmaOfe.Id = TOXCD.TurmaOfe_Id
and
  TOXCD.Id = nvl( p_TOXCD_Id ,0) 
