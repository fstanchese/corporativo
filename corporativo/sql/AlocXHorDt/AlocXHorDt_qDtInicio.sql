select
  AlocXHorDt.* 
from
  AlocXHorDt
where
  trunc(AlocXHorDt.DtInicio) = trunc(sysdate)
and
  AlocXHorDt.State_Id = 3000000010001
order by AlocXHorDt.DtInicio
