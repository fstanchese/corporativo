select
  Count(Total) as Total
from
  (
    select
      Count(HoraAula.Id) as Total,
      HoraAula.Horario_Id,
      HoraAula.TOXCD_Id
    from
      HoraAula,
      Horario,
      TurmaOfe,
      DiscEsp,
      TOXCD,
      Turma
    where
      p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
    and
      Horario.Id = HoraAula.Horario_Id
    and
      HoraAula.TOXCD_Id = TOXCD.ID
    and
      TOXCD.TurmaOfe_Id = TurmaOfe.Id
    and
      Turma.Curso_Id <> 5700000003177 
    and
      Turma.Id = TurmaOfe.Turma_Id  
    and
      TurmaOfe.DiscEsp_Id = DiscEsp.Id
    and
      DiscEsp.AreaAcad_Id = nvl( p_AreaAcad_Id ,0)
    Group By HoraAula.Horario_Id,HoraAula.TOXCD_Id
  )