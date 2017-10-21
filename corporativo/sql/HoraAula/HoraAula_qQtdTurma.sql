select count(distinct turma_id) as total from (
select
  turma.id as turma_id
from
  HoraAula,
  TOXCD,
  TurmaOfe,
  Turma,
  CurrOfe,
  Curr,
  Curso,
  Horario
where
  Curso.CursoNivel_Id not in ( 6200000000002,6200000000008 )
and
  Curr.Curso_Id = Curso.Id
and
  CurrOfe.Curr_Id = Curr.Id
and
  TurmaOfe.Turma_Id = Turma.Id
and
  CurrOfe.Id = TurmaOfe.CurrOfe_Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  HoraAula.Horario_Id = Horario.Id
and
  CurrOfe.Periodo_Id = nvl ( p_Periodo_Id , 0 )
and   
  Horario.Semana_Id = nvl ( p_Semana_Id ,0 )
and
  to_char(Horario.HoraInicio,'hh24:mi') = p_Horario_Hora
and 
  CurrOfe.Campus_Id = nvl ( p_Campus_Id ,0)
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  HoraAula.WPessoa_Prof1_Id = nvl ( p_WPessoa_Id , 0 )
group by Turma.Id
union all
select
  turma.id as turma_id
from
  HoraAula,
  TOXCD,
  TurmaOfe,
  Turma,
  Curso,
  Horario
where
  Curso.CursoNivel_Id not in ( 6200000000002,6200000000008 )
and
  Turma.Curso_Id = Curso.Id
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
  to_char(Horario.HoraInicio,'hh24:mi') = p_Horario_Hora
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  (
    p_Campus_Id is null
    or
    Turma.Campus_Id = p_Campus_Id
  )
and
  (
    p_Periodo_Id is null
    or
    Turma.Periodo_Id = p_Periodo_Id 
  )
and
  HoraAula.WPessoa_Prof1_Id = nvl ( p_WPessoa_Id , 0 )
group by turma.Id
)