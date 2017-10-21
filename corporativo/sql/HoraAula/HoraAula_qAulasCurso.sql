select 
  Count(Total) as total
from 
  (
    select
      Count(HoraAula.Id) as Total,
      HoraAula.Horario_Id,
      TOXCD_Id
    from
      HoraAula,
      Horario,
      TurmaOfe,
      CurrOfe,
      TOXCD,
      Curr
    where
      p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
    and
      Horario.Id = HoraAula.Horario_Id
    and
      HoraAula.TOXCD_Id = TOXCD.ID
    and
      TOXCD.TurmaOfe_Id = TurmaOfe.Id
    and
      TurmaOfe.CurrOfe_Id = CurrOfe.Id
    and
      CurrOfe.Curr_Id = Curr.Id
    and
      Curr.Curso_Id = nvl( p_Curso_Id ,0)
    Group By HoraAula.Horario_Id,TOXCD_Id
  )