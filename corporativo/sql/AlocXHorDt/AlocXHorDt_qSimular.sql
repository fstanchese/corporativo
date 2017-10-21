select
  AlocXHorDt.* 
from
  AlocXHorDt,
  AlocaProf
where
  (
    AlocaProf.Turma_Id = nvl ( p_Turma_Id , 0 )
    or
    p_Turma_Id is null 
  )
and
  AlocaProf.Id = AlocXHorDt.AlocaProf_Id
and
  trunc(alocxhordt.dtinicio) <= p_O_Data
and
  AlocXHorDt.State_Id = 3000000010001
order by AlocXHorDt.DtInicio
