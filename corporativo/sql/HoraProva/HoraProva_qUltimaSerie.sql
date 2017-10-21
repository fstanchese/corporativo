select Turma,CodDisc,Data,Hora,Sala,DuracaoProva,DivTurma
from (
  select
    Periodo.Id                                  as Periodo_id,
    TurmaOfe.Id                                 as TurmaOfe_Id,
    turma.codigo                                as Turma,
    disc.Codigo                                 as CodDisc,
    HoraProva.Data                              as Data,
    to_char(HoraProva.Data,'hh24:mi')           as Hora,
    curr_gnRetDuracao(Curr.Id)                  as Duracao,
    DuracXCi.Sequencia                          as Sequencia,
    HoraProva.Duracao                           as DuracaoProva,
    DivTurma_gsRecognize(HoraProva.DivTurma_Id) as DivTurma,
    Sala_gsRecognize(HoraProva.Sala_Id)         as Sala
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
    Curso,
    DuracXCi
  where
    Turma.DuracXCi_Id = DuracXCi.Id
  and
    (
      Curso.Id = p_Curso_Id
    or
      p_Curso_Id is null
    )
  and
    Curr.Curso_Id = Curso.Id
  and
    CurrOfe.Curr_Id = Curr.Id
  and
    CurrXDisc.Disc_Id = Disc.Id
  and
    Periodo.Id = Turma.Periodo_Id
  and
    (
      p_Campus_Id is null
    or
      Turma.Campus_Id = p_Campus_Id
    )
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
) Tabela
where
  Duracao = Sequencia
order by Data,Hora,DuracaoProva,Turma,CodDisc
