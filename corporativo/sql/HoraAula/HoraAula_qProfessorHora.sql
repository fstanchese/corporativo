
select
 horaaula.id,
 horario.horarioti_id
from
  horaaula,
  horario
where
  horario.id = horaaula.horario_id
and
(
  HoraInicio   = p_Horario_HoraInicio
  and
  Semana_Id    = nvl( p_Semana_Id    ,0)
  and
  Periodo_Id   = nvl( p_Periodo_Id   ,0)
  and
  HorarioTi_Id = nvl( p_HorarioTi_Id ,0)
)
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
(
  WPessoa_Prof1_Id = nvl( p_WPessoa_Id ,0)
  or
  WPessoa_Prof2_Id = nvl( p_WPessoa_Id ,0)
  or
  WPessoa_Prof3_Id = nvl( p_WPessoa_Id ,0)
  or
  WPessoa_Prof4_Id = nvl( p_WPessoa_Id ,0)
)

