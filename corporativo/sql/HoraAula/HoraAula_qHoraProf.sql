select
  Turma.Id           as Turma_Id,
  TOXCD.CurrXDisc_Id as CurrXDisc_Id,
  Turma.Codigo       as Turma,
  CurrXDisc_gsRetCodDIsc(CurrXDisc_Id) as Disc,
  DivTurma_gsRecognize(HoraAula.DivTurma_Id) as Divisao,
  Curso.Id as Curso_Id
from
  HoraAula,
  TOXCD,
  TurmaOfe,
  Turma,
  Curso,
  Horario
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  Turma.Curso_Id = Curso.Id
and
  TurmaOfe.Turma_Id = Turma.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  Horario.Id = HoraAula.Horario_Id
and
  Horario.Semana_Id = nvl ( p_Semana_Id ,0)
and
  Curso.CursoNivel_Id not in ( 6200000000002,6200000000008 )
and 
  to_char(Horario.HoraInicio,'hh24:mi') = p_Horario_Hora
and
  (
    HoraAula.WPessoa_Prof1_Id = nvl( p_WPessoa_Id , 0)
    or
    HoraAula.WPessoa_Prof2_Id = nvl( p_WPessoa_Id , 0)
    or
    HoraAula.WPessoa_Prof3_Id = nvl( p_WPessoa_Id , 0)
    or
    HoraAula.WPessoa_Prof4_Id = nvl( p_WPessoa_Id , 0)
  )
order by 3,4,5
