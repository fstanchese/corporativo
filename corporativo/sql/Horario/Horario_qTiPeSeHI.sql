select
  id  
from
  Horario
where
  HoraInicio   = p_Horario_HoraInicio
and
  Semana_Id    = nvl( p_Horario_Semana_Id    ,0)
and
  Periodo_Id   = nvl( p_Horario_Periodo_Id   ,0)
and
  HorarioTi_Id = nvl( p_Horario_HorarioTi_Id ,0)
