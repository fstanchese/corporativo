select
  count(horaprova.id)                  as Total,
  to_char(HoraProva.data,'dd/mm/yyyy') as Dia
from
  HoraProva,
  TOXCD,
  TurmaOfe,
  Turma,
  DiscEsp
where
  (
  p_Campus_Id is null
  or
  Turma.Campus_Id = nvl( p_Campus_Id ,0)
  )
and
  Turma.Curso_Id = nvl( p_Curso_Id ,0)
and
  DiscEsp.AreaAcad_Id = nvl( p_AreaAcad_Id ,0)
and
  DiscEsp.Id = TurmaOfe.DiscEsp_Id
and
  TurmaOfe.Turma_Id = Turma.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  HoraProva.TOXCD_Id = TOXCD.Id
and
  HoraProva.CriAvalPDt_Id = nvl( p_CriAvalPDt_Id ,0)
group by to_char(HoraProva.data,'dd/mm/yyyy')
order by 2