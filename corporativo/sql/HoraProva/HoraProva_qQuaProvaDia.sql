select
  WPessoa_gsRecognize(HoraProva.WPessoa_Id)       as Professor,
  Turma.Codigo                                    as Turma,
  Disc.Codigo                                     as Disciplina,
  DivTurma_gsRecognize(HoraProva.DivTurma_Id)     as DivTurma,
  to_char(HoraProva.data,'dd/mm/yyyy')            as Dia,
  to_char(HoraProva.data,'HH24:mi')               as Hora,
  HoraProva.Duracao                               as Duracao,
  Sala_gsRecognize(HoraProva.Sala_Id)             as Sala,
  CriAvalPDt_gsRecognize(HoraProva.CriAvalPDt_Id) as Prova,
  Curso_gsRecognize(Curso.Id)                     as Curso,
  Periodo_gsRecognize(Periodo.Id)                 as Periodo,
  to_char(HoraProva.data,'d')                     as DiaSemana,
  turmaofe.id                                     as TurmaOfe_Id
from
  HoraProva,
  TOXCD,
  TurmaOfe,
  CurrOfe,
  Turma,
  Periodo,
  CurrXDisc,
  Disc,
  Curr,
  Curso
where
  Curr.Curso_Id = nvl( p_Curso_Id ,0)
and
  Curr.Curso_Id = Curso.Id
and
  CurrOfe.Curr_Id = Curr.Id
and
  CurrXDisc.Disc_Id = Disc.Id
and
  Periodo.Id = Turma.Periodo_Id
and
  Turma.Periodo_Id = nvl( p_Periodo_Id ,0)
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
order by dia,turma,HoraProva.data