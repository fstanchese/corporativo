select
  to_char(horario.horainicio,'HH24:mi')  as HoraInicio,
  HoraAula_gnAulaTOXCDSemana ( p_O_Data , p_TOXCD_Id , p_Periodo_Id , p_Semana_Id , p_WPessoa_Id , p_DivTurma_Id ) as QtdeAula
from
  HoraAula,
  Horario
where
 (
   HoraAula.WPessoa_Prof1_Id = nvl( p_WPessoa_Id ,0)
    or
   HoraAula.WPessoa_Prof2_Id = nvl( p_WPessoa_Id ,0)
    or
   HoraAula.WPessoa_Prof3_Id = nvl( p_WPessoa_Id ,0)
    or
   HoraAula.WPessoa_Prof4_Id = nvl( p_WPessoa_Id ,0)
 )
and 
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  HoraAula.TOXCD_Id = nvl( p_TOXCD_Id ,0)
and
  (
    p_DivTurma_Id is null
      or
    HoraAula.DivTurma_Id = nvl( p_DivTurma_Id ,0)
  )
and
  Horario.Id = HoraAula.Horario_Id
and
  Horario.Periodo_Id = nvl( p_Periodo_Id ,0)
and
  Horario.Semana_Id = nvl( p_Semana_Id ,0)
order by
  HoraInicio