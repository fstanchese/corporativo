select
  Semana.Numero                         as Numero,
  Semana.Nome                           as Semana,
  to_char(Horario.HoraInicio,'HH24:MI') as Horario,
  Horario.Sequencia                     as Sequencia,
  Horario.id                            as Horario_Id,
  HoraAula.Id                           as HoraAula_Id,
  Semana.Id                             as Semana_Id,
  Turma.Id                              as Turma_Id,
  TurmaOfe.Sala_Id                      as Sala_Id,
  Sala_gsRecognize(TurmaOfe.Sala_Id)    as Sala
from
  HoraAula,
  Horario,
  Semana,
  TOXCD,
  TurmaOfe,
  Turma,
  Curso
where
  (
    p_Facul_Id is null
    or 
    Curso.Facul_Id = nvl( p_Facul_Id , 0)
  ) 
and
  (
    p_Campus_Id is null
    or
    Turma.Campus_Id = nvl ( p_Campus_Id, 0 )
  )
and
  Turma.Curso_Id = Curso.Id
and
  Turma.id=Turmaofe.Turma_id
and
  toxcd.Turmaofe_id=Turmaofe.id
and
  toxcd.id = horaaula.toxcd_id
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  Horario.Semana_Id = Semana.Id
and
  HoraAula.Horario_Id = Horario.Id
and
  (
    HoraAula.DivTurma_Id = nvl( p_DivTurma_Id ,0)
    or
    p_DivTurma_Id is null
  )
and
  (
    HoraAula.TOXCD_Id = nvl( p_TOXCD_Id ,0)
    or
    p_TOXCD_Id is null
  )
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
order by
  Semana.Numero, Horario.HoraInicio, HoraAula.TOXCD_Id