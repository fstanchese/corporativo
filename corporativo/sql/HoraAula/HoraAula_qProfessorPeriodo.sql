oDoc ( aulas do professor em um período (manhã,tarde...) e tipo de horário  )

select
 horaaula.id,
 horario.id,
 horario.horarioti_id,
 to_char(horario.horainicio,'HH24:MI') as hora_inicio,
 to_char(horario.horainicio,'HH24MI')  as horainicio,
 horario.semana_id,
 toxcd_gsretturma(toxcd_id )           as turma,
 toxcd_gsretcoddisc(toxcd_id )         as disciplina
from
  horaaula,
  horario
where
  HorarioTi_Id = nvl( p_HorarioTi_Id ,0)
and
  Periodo_Id = nvl( p_Periodo_Id ,0)
and
  horario.id = horaaula.horario_id
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