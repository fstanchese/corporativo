select
  sum(count(distinct(HoraAula.TOXCD_Id))) as qtde
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
  Horario.Id = HoraAula.Horario_Id
and
  Horario.Periodo_Id = nvl( p_Periodo_Id ,0) 
and
  Horario.Semana_Id = nvl( p_Semana_Id ,0)
 group by HoraAula.TOXCD_Id