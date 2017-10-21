select
  TOXCD.*,
  Disc.Codigo                                        as Disc,
  Disc.Nome                                          as NomeDisc,
  Disc.Id                                            as Disc_Id,
  TOXCD_gsRecognize ( TOXCD.Id )                     as TOXCD_Id_r,
  Turma.Codigo                                       as Turma,
  TurmaOfe_gsRecognize(toxcd.turmaofe_id)||disc.nome as Recognize,
  Turma.TurmaTi_Id                                   as TurmaTi_Id,
  CurrXDisc.ChSemanal                                as ChSemanal,
  CurrXDisc_gnCHTotal(CurrXDisc.Id, p_PLetivo_Id )   as CHAnual,
  WPessoa_gsRecognize(WPessoa_ProfResp_Id)           as ProfResp,
  Curso.CursoNivel_Id                                as CursoNivel_Id,
  WPessoa_gsRecognize(WPessoa_ProfA2_Id)             as WPessoa_ProfA2_Id_r,
  WPessoa_gsRecognize(WPessoa_ProfA3_Id)             as WPessoa_ProfA3_Id_r,
  WPessoa_gsRecognize(WPessoa_ProfA4_Id)             as WPessoa_ProfA4_Id_r,
  Sala_gsRecognize(TurmaOfe.Sala_Id)                 as Sala
from
  Turma,
  TOXCD,
  TurmaOfe,
  CurrXDisc,
  Curr,
  Curso,
  Disc
where
  Curr.Curso_Id = Curso.Id
and
  CurrXDisc.Curr_Id = Curr.Id
and
  Disc.Id = CurrXDisc.Disc_Id
and
  CurrXDisc.Id = TOXCD.CurrXDisc_Id
and
  Turma.Id = TurmaOfe.Turma_Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  TOXCD.id = nvl( p_TOXCD_Id ,0) 