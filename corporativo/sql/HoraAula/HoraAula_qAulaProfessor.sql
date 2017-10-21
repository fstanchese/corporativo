select count( NrAula ) as NrAula from (
(
select
  count(*) as NrAula,
  semana_id,
  to_char(horainicio,'hh24:mi')
from
  HoraAula,
  TOXCD,
  TurmaOfe,
  Turma,
  Curso,
  Horario
where
  HoraAula_gnAulaUnica( WPessoa_Prof1_Id , Horario.Id , p_O_Data , p_TurmaTi_Id )=0
and
  Curso.CursoNivel_Id not in ( 6200000000002,6200000000008 )
and
  Curso.Id = Turma.Curso_Id
and
  (  
    nvl(HoraAula.CustoZero,'off') = p_HoraAula_CustoZero
    or
    p_HoraAula_CustoZero is null      
  )
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  HoraAula.Horario_Id = Horario.Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  (
    Turma.Campus_Id = p_Campus_Id
  or
    p_Campus_Id is null
  )
and
  TurmaOfe.Turma_Id = Turma.Id
and
  (
    Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
    or 
    p_Curso_Id is null
  )
and
  (
    Turma.TurmaTi_Id = nvl ( p_TurmaTi_Id , 0 )
    or 
    p_TurmaTi_Id is null
  )
and
  (
    to_char(horainicio,'hh24:mi') = nvl ( p_Horario_HoraInicioTxt , 0 )
    or 
    p_Horario_HoraInicioTxt is null
  )
and
  (
    Horario.Sequencia = nvl ( p_Horario_Sequencia , 0 )
    or 
    p_Horario_Sequencia is null
  )
and
  (
    Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
    or 
    p_Periodo_Id is null
  )
and
  (
    p_TOXCD_Id is null
      or
    HoraAula.TOXCD_Id = nvl ( p_TOXCD_Id , 0 )
  )
and
  HoraAula.WPessoa_Prof1_Id = nvl( p_WPessoa_Id ,0)
group by semana_id,to_char(horainicio,'hh24:mi')
)
union
(
select
  count(*) as NrAula,
  semana_id,
  to_char(horainicio,'hh24:mi')
from
  HoraAula,
  TOXCD,
  TurmaOfe,
  Turma,
  Curso,
  Horario
where
  HoraAula_gnAulaUnica( WPessoa_Prof2_Id , Horario.Id , p_O_Data , p_TurmaTi_Id )=0
and
  Curso.CursoNivel_Id not in ( 6200000000002,6200000000008 )
and
  Curso.Id = Turma.Curso_Id
and
  (  
    nvl(HoraAula.CustoZero,'off') = p_HoraAula_CustoZero
    or
    p_HoraAula_CustoZero is null      
  )
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  HoraAula.Horario_Id = Horario.Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  (
    Turma.Campus_Id = p_Campus_Id
  or
    p_Campus_Id is null
  )
and
  TurmaOfe.Turma_Id = Turma.Id
and
  (
    Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
    or 
    p_Curso_Id is null
  )
and
  (
    Turma.TurmaTi_Id = nvl ( p_TurmaTi_Id , 0 )
    or 
    p_TurmaTi_Id is null
  )
and
  (
    to_char(horainicio,'hh24:mi') = nvl ( p_Horario_HoraInicioTxt , 0 )
    or 
    p_Horario_HoraInicioTxt is null
  )
and
  (
    Horario.Sequencia = nvl ( p_Horario_Sequencia , 0 )
    or 
    p_Horario_Sequencia is null
  )
and
  (
    Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
    or 
    p_Periodo_Id is null
  )
and
  (
    p_TOXCD_Id is null
      or
    HoraAula.TOXCD_Id = nvl ( p_TOXCD_Id , 0 )
  )
and
  HoraAula.WPessoa_Prof2_Id = nvl( p_WPessoa_Id ,0)
group by semana_id,to_char(horainicio,'hh24:mi')
)
union
(
select
  count(*) as NrAula,
  semana_id,
  to_char(horainicio,'hh24:mi')
from
  HoraAula,
  TOXCD,
  TurmaOfe,
  Turma,
  Curso,
  Horario
where
  HoraAula_gnAulaUnica( WPessoa_Prof3_Id , Horario.Id , p_O_Data , p_TurmaTi_Id )=0
and
  Curso.CursoNivel_Id not in ( 6200000000002,6200000000008 )
and
  Curso.Id = Turma.Curso_Id
and
  (  
    nvl(HoraAula.CustoZero,'off') = p_HoraAula_CustoZero
    or
    p_HoraAula_CustoZero is null      
  )
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  HoraAula.Horario_Id = Horario.Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  (
    Turma.Campus_Id = p_Campus_Id
  or
    p_Campus_Id is null
  )
and
  TurmaOfe.Turma_Id = Turma.Id
and
  (
    Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
    or 
    p_Curso_Id is null
  )
and
  (
    Turma.TurmaTi_Id = nvl ( p_TurmaTi_Id , 0 )
    or 
    p_TurmaTi_Id is null
  )
and
  (
    to_char(horainicio,'hh24:mi') = nvl ( p_Horario_HoraInicioTxt , 0 )
    or 
    p_Horario_HoraInicioTxt is null
  )
and
  (
    Horario.Sequencia = nvl ( p_Horario_Sequencia , 0 )
    or 
    p_Horario_Sequencia is null
  )
and
  (
    Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
    or 
    p_Periodo_Id is null
  )
and
  (
    p_TOXCD_Id is null
      or
    HoraAula.TOXCD_Id = nvl (  p_TOXCD_Id , 0 )
  )
and
  HoraAula.WPessoa_Prof3_Id = nvl( p_WPessoa_Id ,0)
group by semana_id,to_char(horainicio,'hh24:mi')
)
union
(
select
  count(*) as NrAula,
  semana_id,
  to_char(horainicio,'hh24:mi')
from
  HoraAula,
  TOXCD,
  TurmaOfe,
  Turma,
  Curso,
  Horario
where
  HoraAula_gnAulaUnica( WPessoa_Prof4_Id , Horario.Id , p_O_Data , p_TurmaTi_Id )=0
and
  Curso.CursoNivel_Id not in ( 6200000000002,6200000000008 )
and
  Curso.Id = Turma.Curso_Id
and
  (  
    nvl(HoraAula.CustoZero,'off') = p_HoraAula_CustoZero
    or
    p_HoraAula_CustoZero is null      
  )
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  HoraAula.Horario_Id = Horario.Id
and
  HoraAula.TOXCD_Id = TOXCD.Id
and
  TOXCD.TurmaOfe_Id = TurmaOfe.Id
and
  (
    Turma.Campus_Id = p_Campus_Id
  or
    p_Campus_Id is null
  )
and
  TurmaOfe.Turma_Id = Turma.Id
and
  (
    Turma.Curso_Id = nvl ( p_Curso_Id , 0 )
    or 
    p_Curso_Id is null
  )
and
  (
    Turma.TurmaTi_Id = nvl ( p_TurmaTi_Id , 0 )
    or 
    p_TurmaTi_Id is null
  )
and
  (
    to_char(horainicio,'hh24:mi') = nvl ( p_Horario_HoraInicioTxt , 0 )
    or 
    p_Horario_HoraInicioTxt is null
  )
and
  (
    Horario.Sequencia = nvl ( p_Horario_Sequencia , 0 )
    or 
    p_Horario_Sequencia is null
  )
and
  (
    Horario.Periodo_Id = nvl ( p_Periodo_Id , 0 )
    or 
    p_Periodo_Id is null
  )
and
  (
    p_TOXCD_Id is null
      or
    HoraAula.TOXCD_Id = nvl ( p_TOXCD_Id , 0 )
  )
and
  HoraAula.WPessoa_Prof4_Id = nvl( p_WPessoa_Id ,0)
group by semana_id,to_char(horainicio,'hh24:mi')
)
)