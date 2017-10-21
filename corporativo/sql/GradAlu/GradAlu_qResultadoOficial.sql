select
  Sala_gsRecognize(HoraProva.Sala_Id)              as Sala,
  to_char(sysdate,'dd/mm/yyyy')                    as Dia,
  to_char(sysdate,'HH24:mi')                       as Hora,
  WPessoa_gsRecognize(TOXCD.WPessoa_ProfResp_Id)   as Professor,
  Turma.Codigo                                     as Turma,
  Disc.Codigo                                      as CodDisc,
  shortname(Disc.Nome,30)                          as NomeDisc,
  Curso.Nome                                       as Curso, 
  AreaAcad.Nome                                    as AreaAcad,
  HoraProva.TOXCD_Id                               as TOXCD_Id
from
  HoraProva,
  TOXCD,
  TurmaOfe,
  CurrOfe,
  Turma,
  CurrXDisc,
  Curr,
  Disc,  
  Curso,
  Facul,
  AreaAcad
where
  Facul.AreaAcad_Id = AreaAcad.Id
and
  Curso.Facul_Id = Facul.Id
and
  Curr.Curso_Id = Curso.Id
and
  CurrXDisc.Curr_Id = Curr.Id
and
  CurrXDisc.Disc_Id = Disc.Id
and
  TurmaOfe.Turma_Id = Turma.Id
and
  TOXCD.CurrXDisc_Id = CurrXDisc.Id
and
  TurmaOfe.Turma_Id = Turma.Id
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  HoraProva.TOXCD_Id = TOXCD.Id
and
  HoraProva.CriAvalPDt_Id = nvl( p_CriAvalPDt_Id ,0)
and
(
  p_TOXCD_Id is null
  or
  TOXCD_Id = nvl( p_TOXCD_Id ,0)
)
and
  rownum=1
order by
  Dia,Curso,Turma