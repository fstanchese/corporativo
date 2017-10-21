select
  Horario.*,
  Horario_gsRecognize(Horario.Id) as Recognize
from
  Horario
where
  Horario.HorarioTi_Id = 12800000000003
order by
  Semana_Id,HoraInicio
