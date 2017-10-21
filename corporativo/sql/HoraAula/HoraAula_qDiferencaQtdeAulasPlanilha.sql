select
  horario.id,
  horario.horarioti_id,
  to_char(horario.horainicio,'HH24:MI') as hora_inicio,
  horario.semana_id,
  Semana_gsRecognize(Semana_Id)         as Semana_Recognize, 
  toxcd_gsretturma(toxcd_id )           as turma,
  toxcd_gsretcoddisc(toxcd_id )         as disciplina,
  Curso_gsRecognize(TurmaOfe_gnRetCurso(TurmaOfe_Id)) as Curso,
  Sala_gsRecognize(nvl(HoraAula.Sala_Especial_Id,TurmaOfe_gnRetSala(TurmaOfe_Id))) as Sala
from
  HoraAula,
  Horario,
  TOXCD
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  HoraAula.Horario_Id = Horario.Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  TurmaOfe_gnRetTurmaTi(TurmaOfe_Id) = 6600000000001
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
order by Semana_Id, hora_inicio