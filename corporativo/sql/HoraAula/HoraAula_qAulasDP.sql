select
  Count(Total) as total,
  AreaAcad_Id,
  AreaAcad_gsRecognize(AreaAcad_Id) as Recognize
from
  (
    select
      Count(HoraAula.Id) as Total,
      HoraAula.Horario_Id,
      HoraAula.TOXCD_Id,
      DiscEsp.AreaAcad_Id as AreaAcad_Id
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
    Group By HoraAula.Horario_Id,HoraAula.TOXCD_Id,DiscEsp.AreaAcad_Id
  )
group by AreaAcad_Id
