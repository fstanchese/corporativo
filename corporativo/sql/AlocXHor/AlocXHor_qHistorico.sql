select
  'Em '||to_char(alocxhorhi.dt,'dd/mm/yyyy')||' de '||Horario_gsRecognize(to_number(AlocXHorHi.old))||' para '||Horario_gsRecognize(to_number(AlocXHorHi.new)) as recognize
from
  AlocXHorHi,
  AlocXHor
where
  Upper(Col) like 'HORARIO%'
and
  AlocXHor.Id = AlocXHorHi.AlocXHor_Id
and
  AlocXHor.AlocaProf_Id = nvl ( p_AlocaProf_Id , 0 )
and
  trunc(alocxhorhi.dt) = p_O_Data
order by alocxhorhi.dt desc,alocxhorhi.col
