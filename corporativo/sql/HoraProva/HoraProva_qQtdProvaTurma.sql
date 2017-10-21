select
  count(horaprova.id) as Total,
  Periodo.Id          as Periodo_id,
  TurmaOfe.Id         as TurmaOfe_Id,
  turma.codigo        as turma
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
  (
    p_Campus_Id is null
    or
    Turma.Campus_Id = nvl ( p_Campus_Id ,0)
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
group by
  Periodo.Id,
  TurmaOfe.Id,
  turma.codigo
order by 2,4,3
