select
  HoraAula.*
from
  HoraAula
where
  HoraAula.TOXCD_ID = nvl ( p_TOXCD_Id , 0 )
and
  HoraAula.AulaTi_Id = nvl ( p_AulaTi_Id , 0 )
and
  HoraAula.Horario_Id = nvl ( p_Horario_Id , 0 )
and
  trunc(HoraAula.DtInicio) = p_HoraAula_DtInicio
and
  trunc(HoraAula.DtTermino) = p_HoraAula_DtTermino
and
  nvl ( HoraAula.DivTurma_Id , 0 ) = nvl ( p_DivTurma_Id , 0 )
