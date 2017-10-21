select 
  Horario.id as Id,
  to_char(HoraInicio,'hh24:mi') as Recognize 
from 
  Horario 
where 
  (
    p_Periodo_Id is null
    or
    Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
  )
and
  Horario.Semana_Id = nvl ( p_Semana_Horario_03_Id , 0 )
order by Oficial,Recognize