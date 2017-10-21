select
  count(distinct Turma.TurmaTi_Id) as total,
  to_char(horainicio,'hh24:mi') AS INICIO,
  horario.semana_id
from
  HoraAula,
  Horario,
  TurmaOfe,
  TOXCD,
  Curso,
  Turma,
  facul
where
  Curso.Facul_Id = Facul.Id (+)
and
  Horario.Id = HoraAula.Horario_Id
and
  HoraAula.TOXCD_Id = TOXCD.ID
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  Turma.id = turmaofe.turma_id
and
  Curso.Id = Turma.Curso_id
and
  Curso.CursoNivel_Id not in ( 6200000000002,6200000000008 )
and
  nvl(HoraAula.CustoZero,'off') = p_HoraAula_CustoZero
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  (
    HoraAula.WPessoa_Prof1_Id = nvl ( p_WPessoa_Id , 0 )
    or
    HoraAula.WPessoa_Prof2_Id = nvl ( p_WPessoa_Id , 0 )
    or
    HoraAula.WPessoa_Prof3_Id = nvl ( p_WPessoa_Id , 0 )
    or
    HoraAula.WPessoa_Prof4_Id = nvl ( p_WPessoa_Id , 0 )
  )
group by to_char(horainicio,'hh24:mi'),horario.semana_id