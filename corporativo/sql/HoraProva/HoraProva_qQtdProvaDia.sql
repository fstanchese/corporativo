select
  count(horaprova.id)                  as Total,
  to_char(HoraProva.data,'dd/mm/yyyy') as Dia
from
  HoraProva,
  TOXCD,
  TurmaOfe,
  CurrOfe,
  Turma,
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
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  HoraProva.TOXCD_Id = TOXCD.Id
and
  HoraProva.CriAvalPDt_Id = nvl( p_CriAvalPDt_Id ,0)
group by to_char(HoraProva.data,'dd/mm/yyyy')
order by 2