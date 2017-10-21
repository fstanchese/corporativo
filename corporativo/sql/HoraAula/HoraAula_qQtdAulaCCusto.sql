select 
  1/count(distinct(Turma.Curso_Id)) as Quantidade
from
  HoraAula,
  Horario,
  TOXCD,
  TurmaOfe,
  Turma
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  (
    Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
    or
    p_Curso_Id is null
  )
and
  (
    Turma.Campus_Id = nvl ( p_Campus_Id ,0 )
    or
    p_Campus_Id is null
  )
and
  TurmaOfe.Turma_Id = Turma.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  HoraAula.Horario_Id = Horario.Id
and
  Horario.Semana_Id = nvl ( p_Semana_Id ,0 )
and
  to_char(Horario.HoraInicio,'hh24:mi') = p_O_Search
and
(
  HoraAula.WPessoa_Prof1_Id = nvl ( p_WPessoa_Id ,0 )
or
  HoraAula.WPessoa_Prof2_Id = nvl ( p_WPessoa_Id ,0 )
or
  HoraAula.WPessoa_Prof3_Id = nvl ( p_WPessoa_Id ,0 )
or
  HoraAula.WPessoa_Prof4_Id = nvl ( p_WPessoa_Id ,0 )
)
