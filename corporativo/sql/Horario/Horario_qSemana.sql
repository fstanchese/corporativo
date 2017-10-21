select 
  Horario.id 
from 
  Horario 
where 
  oficial='on'
and
  Periodo_Id = nvl ( p_Periodo_Id , 0 )
and
  Semana_Id = nvl ( p_Semana_Id , 0 )
and 
  to_char(HoraInicio,'hh24:mi') = '$v_HoraIni'
