select
  count(horaProva.Id) as TOTAL,
  Curso.Nome as Curso,
  Periodo.Nome as Periodo,
  to_char(HoraProva.data,'dd/mm/yyyy') as Dia
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
  trunc(HoraProva.data) = p_HoraProva_DataProva 
and
   HoraProva.Facul_Id is null
and
  HoraProva.CriAvalPDt_Id = nvl( p_CriAvalPDt_Id ,0)
group by
  Curso.Nome,
  Periodo.Nome,
  to_char(HoraProva.data,'dd/mm/yyyy')
