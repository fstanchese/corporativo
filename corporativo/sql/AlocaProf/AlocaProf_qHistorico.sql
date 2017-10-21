select
  'Em '||to_char(AlocaProfHi.dt,'dd/mm/yyyy')||' de '||Professor_gsRecognize(to_number(AlocaProfHi.old))||' para '||Professor_gsRecognize(to_number(AlocaProfHi.new)) as recognize
from
  AlocaProfHi,
  AlocaProf
where
  Upper(Col) like 'PROFESSOR%'
and
  AlocaProf.Id = AlocaProfHi.AlocaProf_Id
and
  AlocaProfHi.AlocaProf_Id = nvl ( p_AlocaProf_Id , 0 )
and
  trunc(alocaprofhi.dt) = p_O_Data
order by alocaprofhi.dt desc,alocaprofhi.col
