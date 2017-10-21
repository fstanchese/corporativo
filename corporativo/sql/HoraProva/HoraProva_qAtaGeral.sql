select
  TOXCD_gsRecognize(HoraProva.TOXCD_Id)            as TOXCD,
  Sala_gsRecognize(HoraProva.Sala_Id)              as Sala,
  CriAvalPDt_gsRecognize(HoraProva.CriAvalPDt_Id)  as CriAvalPDt,
  DivTurma_gsRecognize(HoraProva.DivTurma_Id)      as DivTurma,
  to_char(HoraProva.data,'dd/mm/yyyy')             as Dia,
  to_char(HoraProva.data,'HH24:mi')                as Hora,
  WPessoa_gsRecognize(HoraProva.WPessoa_Id)        as Professor,
  Turma.Codigo                                     as Turma,
  Disc.Codigo                                      as CodDisc,
  Disc.Nome                                        as NomeDisc,
  WPessoa.Nome                                     as Aluno,
  WPessoa.Codigo                                   as Codigo,
  Curso.Nome                                       as Curso
from
  HoraProva,
  TOXCD,
  TurmaOfe,
  CurrOfe,
  Turma,
  CurrXDisc,
  Disc,
  Curr,
  Curso,
  GradAlu,
  WPessoa
where
  GradAlu.WPessoa_Id = WPessoa.Id
and
  GradAlu.TurmaOfe_Id = TurmaOfe.Id
and
  Curr.Curso_Id = Curso.Id
and
  CurrOfe.Curr_Id = Curr.Id
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
order by
  Dia, Turma, NomeDisc, Aluno