(
select
  count(*)                      as NrAula,
  semana_id                     as Semana_Id,
  to_char(horainicio,'hh24:mi') as Horario,
  TurmaOfe.Id                   as TurmaOfe_Id
from
  HoraAula,
  TOXCD,
  TurmaOfe,
  Turma,
  Horario
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  (
    Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
    or
    p_Curso_Id is null
  )
and
  HoraAula.Horario_Id = Horario.Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  TurmaOfe.Turma_Id = Turma.Id
and
  nvl(HoraAula.CustoZero,'off') = 'off'
and
  HoraAula.WPessoa_Prof1_Id = nvl( p_WPessoa_Id ,0)
group by semana_id,to_char(horainicio,'hh24:mi'),Turma.Curso_Id,TurmaOfe.Id
)
union
(
select
  count(*)                      as NrAula,
  semana_id                     as Semana_Id,
  to_char(horainicio,'hh24:mi') as Horario,
  TurmaOfe.Id                   as TurmaOfe_Id
from
  HoraAula,
  TOXCD,
  TurmaOfe,
  Turma,
  Horario
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  (
    Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
    or
    p_Curso_Id is null
  )
and
  HoraAula.Horario_Id = Horario.Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  TurmaOfe.Turma_Id = Turma.Id
and
  nvl(HoraAula.CustoZero,'off') = 'off'
and
  HoraAula.WPessoa_Prof2_Id = nvl( p_WPessoa_Id ,0)
group by semana_id,to_char(horainicio,'hh24:mi'),Turma.Curso_Id,TurmaOfe.Id
)
union
(
select
  count(*)                       as NrAula,
  semana_id                      as Semana_Id,
  to_char(horainicio,'hh24:mi')  as Horario,
  TurmaOfe.Id                   as TurmaOfe_Id
from
  HoraAula,
  TOXCD,
  TurmaOfe,
  Turma,
  Horario
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  (
    Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
    or
    p_Curso_Id is null
  )
and
  HoraAula.Horario_Id = Horario.Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  TurmaOfe.Turma_Id = Turma.Id
and
  nvl(HoraAula.CustoZero,'off') = 'off'
and
  HoraAula.WPessoa_Prof3_Id = nvl( p_WPessoa_Id ,0)
group by semana_id,to_char(horainicio,'hh24:mi'),Turma.Curso_Id,TurmaOfe.Id
)
union
(
select
  count(*)                      as NrAula,
  semana_id                     as Semana_Id,
  to_char(horainicio,'hh24:mi') as Horario,
  TurmaOfe.Id                   as TurmaOfe_Id
from
  HoraAula,
  TOXCD,
  TurmaOfe,
  Turma,
  Horario
where
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  (
    Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
    or
    p_Curso_Id is null
  )
and
  HoraAula.Horario_Id = Horario.Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  TurmaOfe.Turma_Id = Turma.Id
and
  nvl(HoraAula.CustoZero,'off') = 'off'
and
  HoraAula.WPessoa_Prof4_Id = nvl( p_WPessoa_Id ,0)
group by semana_id,to_char(horainicio,'hh24:mi'),Turma.Curso_Id,TurmaOfe.Id
)
