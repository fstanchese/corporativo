select 
  count(*) as total,
  semana_id,
  horas,
  wpessoa_id,
  periodo_id,
  campus_id 
from 
(
select
  horario.semana_id                     as semana_id,
  to_char(Horario.HoraInicio,'hh24:mi') as horas,
  horaaula.wpessoa_prof1_id             as wpessoa_id,
  currofe.periodo_id                    as periodo_id,
  currofe.campus_id                     as campus_id
from
  HoraAula,
  TOXCD,
  TurmaOfe,
  Turma,
  CurrOfe,
  Curr,
  Curso,
  Horario,
  WPessoa
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
  WPessoa.Id = HoraAula.WPessoa_Prof1_Id   
and
  (
    p_Curso_Id is null
    or
    Curso.Id = nvl ( p_Curso_Id , 0 )
  )   
and
  ( 
    p_Campus_Id is null
    or		
    CurrOfe.Campus_Id = nvl ( p_Campus_Id , 0 ) 
  )   
and
  ( 
    p_Periodo_Id is null
    or		
    CurrOfe.Periodo_Id = nvl ( p_Periodo_Id , 0 ) 
  )
and
  (
     p_Class_Id is null
     or
     WPessoa.Class_Id = nvl ( p_Class_Id , 0 )
  )
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
union all
select
  horario.semana_id                     as semana_id,
  to_char(Horario.HoraInicio,'hh24:mi') as horas,
  horaaula.wpessoa_prof2_id             as wpessoa_id,
  currofe.periodo_id                    as periodo_id,
  currofe.campus_id                     as campus_id
from
  HoraAula,
  TOXCD,
  TurmaOfe,
  Turma,
  CurrOfe,
  Curr,
  Curso,
  Horario,
  WPessoa
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
  WPessoa.Id = HoraAula.WPessoa_Prof2_Id   
and
  (
    p_Curso_Id is null
    or
    Curso.Id = nvl ( p_Curso_Id , 0 )
  )   
and
  ( 
    p_Campus_Id is null
    or		
    CurrOfe.Campus_Id = nvl ( p_Campus_Id , 0 ) 
  )   
and
  ( 
    p_Periodo_Id is null
    or		
    CurrOfe.Periodo_Id = nvl ( p_Periodo_Id , 0 ) 
  )   
and
  (
     p_Class_Id is null
     or
     WPessoa.Class_Id = nvl ( p_Class_Id , 0 )
  )
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  horaaula.wpessoa_prof2_id is not null
union all
select
  horario.semana_id                     as semana_id,
  to_char(Horario.HoraInicio,'hh24:mi') as horas,
  horaaula.wpessoa_prof3_id             as wpessoa_id,
  currofe.periodo_id                    as periodo_id,
  currofe.campus_id                     as campus_id
from
  HoraAula,
  TOXCD,
  TurmaOfe,
  Turma,
  CurrOfe,
  Curr,
  Curso,
  Horario,
  WPessoa
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
  WPessoa.Id = HoraAula.WPessoa_Prof3_Id   
and
  (
    p_Curso_Id is null
    or
    Curso.Id = nvl ( p_Curso_Id , 0 )
  )   
and
  ( 
    p_Campus_Id is null
    or		
    CurrOfe.Campus_Id = nvl ( p_Campus_Id , 0 ) 
  )   
and
  ( 
    p_Periodo_Id is null
    or		
    CurrOfe.Periodo_Id = nvl ( p_Periodo_Id , 0 ) 
  )   
and
  (
     p_Class_Id is null
     or
     WPessoa.Class_Id = nvl ( p_Class_Id , 0 )
  )
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  horaaula.wpessoa_prof3_id is not null
union all
select
  horario.semana_id                     as semana_id,
  to_char(Horario.HoraInicio,'hh24:mi') as horas,
  horaaula.wpessoa_prof4_id             as wpessoa_id,
  currofe.periodo_id                    as periodo_id,
  currofe.campus_id                     as campus_id
from
  HoraAula,
  TOXCD,
  TurmaOfe,
  Turma,
  CurrOfe,
  Curr,
  Curso,
  Horario,
  WPessoa
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
  WPessoa.Id = HoraAula.WPessoa_Prof4_Id   
and
  (
    p_Curso_Id is null
    or
    Curso.Id = nvl ( p_Curso_Id , 0 )
  )   
and
  ( 
    p_Campus_Id is null
    or		
    CurrOfe.Campus_Id = nvl ( p_Campus_Id , 0 ) 
  )   
and
  ( 
    p_Periodo_Id is null
    or		
    CurrOfe.Periodo_Id = nvl ( p_Periodo_Id , 0 ) 
  )   
and
  (
     p_Class_Id is null
     or
     WPessoa.Class_Id = nvl ( p_Class_Id , 0 )
  )
and
  p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
and
  horaaula.wpessoa_prof4_id is not null
union all
  select
    horario.semana_id                     as semana_id,
    to_char(Horario.HoraInicio,'hh24:mi') as horas,
    horaaula.wpessoa_prof1_id             as wpessoa_id,
    horario.Periodo_Id                    as periodo_id,
    Turma.Campus_Id                       as campus_id
  from
    Horario,
    HoraAula,
    WPessoa,
    TOXCD,
    TurmaOfe,
    Turma,
    DiscEsp,
    Curso
  where
    HoraAula.Horario_Id = Horario.Id
  and
    Turma.Curso_Id = Curso.Id
  and
    Curso.CursoNivel_Id in ( 6200000000001,6200000000003 )
  and
    HoraAula.WPessoa_Prof1_Id = WPessoa.Id
  and
    DiscEsp.Id = TurmaOfe.DiscEsp_Id
  and
    TurmaOfe.Turma_Id = Turma.Id
  and
    TurmaOfe.Id = TOXCD.TurmaOfe_Id
  and
    TOXCD.Id = HoraAula.TOXCD_Id
  and
    (
      p_Curso_Id is null
      or
      Turma.Curso_Id = p_Curso_Id 
    )
  and
    (
      p_Class_Id is null
      or
      WPessoa.Class_Id = nvl ( p_Class_Id , 0 )
    )
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
    p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
) group by semana_id,horas,wpessoa_id,periodo_id,campus_id
order by 1,2,3