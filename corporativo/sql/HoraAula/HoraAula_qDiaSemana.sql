select
  count(id) 
from
  HoraAula,
  Horario,
  Semana
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  Semana.Numero = to_char ( p_O_Dt , 'd' )
and
  Horario.Semana_Id = Semana.Id
and
  HoraAula.Horario_Id = Horario.Id
and
  HoraAula.TOXCD_Id = nvl( p_TOXCD_Id ,0)
order by
