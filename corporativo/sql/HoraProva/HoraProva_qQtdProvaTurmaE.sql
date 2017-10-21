select
  count(horaprova.id) as Total,
  DiscEsp.AreaAcad_Id as AreaAcad_id,
  TurmaOfe.Id         as TurmaOfe_Id,
  turma.codigo        as turma
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
group by
  DiscEsp.AreaAcad_Id,
  TurmaOfe.Id,
  turma.codigo
order by 3,4