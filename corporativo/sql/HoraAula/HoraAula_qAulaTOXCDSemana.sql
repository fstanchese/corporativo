select
  Count(*) as Qtde
from
  (
    select
      to_char(horario.horainicio,'HH24:mi')  as HoraInicio
    from
      HoraAula,
      Horario
    where
      (
        WPessoa_Prof1_Id = nvl( p_WPessoa_Id ,0)
          or
        WPessoa_Prof2_Id = nvl( p_WPessoa_Id ,0)
          or
        WPessoa_Prof3_Id = nvl( p_WPessoa_Id ,0)
          or
        WPessoa_Prof4_Id = nvl( p_WPessoa_Id ,0)
      )
    and
      p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
    and
      Horario.Id = HoraAula.Horario_Id
    and
      (
        p_DivTurma_Id is null  
         or
        HoraAula.DivTurma_Id = nvl ( p_DivTurma_Id ,0)
      )
    and
      HoraAula.TOXCD_Id = nvl( p_TOXCD_Id ,0)
    and
      Horario.Periodo_Id = nvl( p_Periodo_Id ,0)
    and
      Horario.Semana_Id = nvl( p_Semana_Id ,0)
    group by to_char(horario.horainicio,'HH24:mi')
  )