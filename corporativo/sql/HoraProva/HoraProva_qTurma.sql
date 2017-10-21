select
  WPessoa_gsRecognize(HoraProva.WPessoa_Id)    as Professor,
  TOXCD_gsRetTurma(HoraProva.TOXCD_Id)         as Turma,
  TOXCD_gsRetDisciplina(HoraProva.TOXCD_Id)    as Disciplina,
  DivTurma_gsRecognize(HoraProva.DivTurma_Id)  as DivTurma,
  to_char(HoraProva.data,'dd/mm/yyyy')         as Dia,
  to_char(HoraProva.data,'HH24:mi')            as Hora,
  Sala_gsRecognize(HoraProva.Sala_Id)          as Sala,
  HoraProva.Duracao                            as Duracao
from
  HoraProva,
  TOXCD
where
  HoraProva.TOXCD_Id = TOXCD.Id
and
  TOXCD.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0)
and
  HoraProva.CriAvalPDt_Id = nvl( p_CriAvalPDt_Id ,0)
order by
  Turma,Dia,Hora,Disciplina