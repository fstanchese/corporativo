select
  to_char(horainicio,'hh24:mi') as horainicio,
  horario.semana_id,
  Turma.Codigo as Turma,
  TOXCD_gsRetCodDisc(HoraAula.TOXCD_Id) as Disciplina,
  DivTurma_gsRecognize(HoraAula.DivTurma_Id) as DivTurma,
  AulaTi_gsRecognize(HoraAula.AulaTi_Id) as TipoAula   
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
  Curso.CursoNivel_Id in ( 6200000000001,6200000000003,6200000000010,6200000000012 )
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
order by semana_id,horainicio,turma,disciplina