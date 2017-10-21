select
  AlocXHorDt.Id as Id,
  AlocXHorDt_gsRecognize(Id) as Recognize,
  AlocXHorDt.State_Id,
  AlocXHorDt.AlocaProf_Id,
  AlocXHorDt.DtInicio,
  AlocXHorDt.Professor_Id 
from
  AlocXHorDt
where
  AlocXHorDt.AlocaProf_Id = nvl ( p_AlocaProf_Id , 0 )
and
  AlocXHorDt.Indice = nvl ( p_O_Numero , 0 )
order by AlocXHorDt.DtInicio desc
