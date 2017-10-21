(
select
  CurrXDisc_gsRetCodDisc(GradAlu.CurrXDisc_Id) as Disciplina,
  to_char(HoraProva.Data,'dd/mm/yyyy')         as Data,
  to_char(HoraProva.Data,'HH24:MI')            as Hora,
  sala_gsRecognize(HoraProva.Sala_Id)          as Sala,
  HoraProva.Duracao                            as Duracao,
  TurmaOfe_gsRetCodTurma(TOXCD.TurmaOfe_Id)    as Turma,
  DivTurma_gsRecognize(HoraProva.DivTurma_Id)  as DivTurma
from
  GradAlu,
  TOXCD,
  HoraProva,
  CriAvalPDt
where
(
  HoraProva.DivTurma_Id = 13500000000016
or
  HoraProva.DivTurma_Id = WPessoa_gnParImpar( p_WPessoa_Id )
)
and
  GradAlu.CurrXDisc_Id = TOXCD.CurrXDisc_Id
and
  GradAlu.TurmaOfe_Id = TOXCD.TurmaOfe_Id
and
  HoraProva.TOXCD_ID = TOXCD.Id
and
  HoraProva.CriAvalPDt_Id = CriAvalPDt.Id
and
  GradAlu.WPessoa_Id = nvl( p_WPessoa_Id ,0)
and
  CriAvalPDt.Id = nvl( p_CriAvalPDt_Id ,0)
)
union
(
select
  CurrXDisc_gsRetCodDisc(GradAlu.CurrXDisc_Id) as Disciplina,
  to_char(HoraProva.Data,'dd/mm/yyyy')         as Data,
  to_char(HoraProva.Data,'HH24:MI')            as Hora,
  sala_gsRecognize(HoraProva.Sala_Id)          as Sala,
  HoraProva.Duracao                            as Duracao,
  TurmaOfe_gsRetCodTurma(TOXCD.TurmaOfe_Id)    as Turma,
  DivTurma_gsRecognize(HoraProva.DivTurma_Id)  as DivTurma
from
  GradAlu,
  TOXCD,
  HoraProva,
  CriAvalPDt,
  TurmaOfe
where
(
  HoraProva.DivTurma_Id = 13500000000016
or
  HoraProva.DivTurma_Id = WPessoa_gnParImpar( p_WPessoa_Id )
)
and
  TurmaOfe.CurrOfe_Id is Null 
and
  TurmaOfe.Id = GradAlu.TurmaOfe_Id
and
  GradAlu.TurmaOfe_Id = TOXCD.TurmaOfe_Id
and
  HoraProva.TOXCD_ID = TOXCD.Id 
and
  HoraProva.CriAvalPDt_Id = CriAvalPDt.Id
and
  GradAlu.GradAluTi_Id <> 8500000000001 
and
  GradAlu.WPessoa_Id = nvl( p_WPessoa_Id ,0)
and
  CriAvalPDt.Id = nvl( p_CriAvalPDt_Id ,0)
)
order by data