select 
  count(*) as aulas,
  WPessoa_Id,
  Semana_Id,
  Hora
from
(
  select
    WPessoa_Prof1_Id                      as WPessoa_Id,
    Horario.Semana_Id                     as Semana_Id,
    to_char(Horario.HoraInicio,'HH24:MI') as Hora,
    curr.curso_id                         as curso_id   
  from
    HoraAula,
    Horario,
    TurmaOfe,
    CurrOfe,
    TOXCD,
    Curr,
    WPessoa,
    Curso,
    Turma,
    DuracXCi,
    Facul
  where
    Curso.Facul_Id = Facul.Id
  and
    Horario.Id = HoraAula.Horario_Id
  and
    HoraAula.TOXCD_Id = TOXCD.ID
  and
    TOXCD.TurmaOfe_Id = TurmaOfe.Id
  and
    TurmaOfe.CurrOfe_Id = CurrOfe.Id
  and
    CurrOfe.Curr_Id = Curr.Id
  and
    WPessoa.Id = HoraAula.WPessoa_Prof1_Id
  and
    duracxci.id = turma.duracxci_id
  and
    turma.id = turmaofe.turma_id
  and
    Curr.Curso_Id = Curso.Id
  and
    Curso.CursoNivel_Id in ( 6200000000001,6200000000010 )
  and
    p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
  and
    Admissao_gnAtivo ( nvl ( WPessoa_Prof1_Id, 0 ) , p_O_Data ) = 1
  and
    (
      p_TurmaOfe_Id is null
      or
      TurmaOfe.Id = nvl ( p_TurmaOfe_Id , 0)
    )
  and
    (
      p_DuracXCi_Sequencia is null
      or
      DuracXCi.Sequencia = nvl( p_DuracXCi_Sequencia , 0)
    )
  and
    (
      p_Periodo_Id is null
      or
      CurrOfe.Periodo_Id = nvl( p_Periodo_Id ,0)
    )
  and
    (
      p_Curso_Id is null
      or
      Curso.Id =  nvl( p_Curso_Id ,0)
    )
  and
    (
      p_Campus_Id is null
      or
      CurrOfe.Campus_Id  = nvl( p_Campus_Id ,0)
    )
  and
    (
      p_Facul_Id is null
      or
      Curso.Facul_Id  = nvl( p_Facul_Id ,0)
    )
  and
    HoraAula.WPessoa_Prof1_Id = nvl ( p_WPessoa_Id , 0 )
  union all
  select
    WPessoa_Prof2_Id         as WPessoa_Id,
    Horario.Semana_Id        as Semana_Id,
    to_char(Horario.HoraInicio,'HH24:MI') as Hora,
    curr.curso_id            as curso_id   
  from
    HoraAula,
    Horario,
    TurmaOfe,
    CurrOfe,
    TOXCD,
    Curr,
    WPessoa,
    Curso,
    Turma,
    DuracXCi,
    Facul
  where
    Curso.Facul_Id = Facul.Id
  and
    Horario.Id = HoraAula.Horario_Id
  and
    HoraAula.TOXCD_Id = TOXCD.ID
  and
    TOXCD.TurmaOfe_Id = TurmaOfe.Id
  and
    TurmaOfe.CurrOfe_Id = CurrOfe.Id
  and
    CurrOfe.Curr_Id = Curr.Id
  and
    WPessoa.Id = HoraAula.WPessoa_Prof2_Id
  and
    duracxci.id = turma.duracxci_id
  and
    turma.id = turmaofe.turma_id
  and
    Curr.Curso_Id = Curso.Id
  and
    Curso.CursoNivel_Id in ( 6200000000001,6200000000010 )
  and
    p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
  and
    Admissao_gnAtivo ( nvl ( WPessoa_Prof2_Id, 0 ) , p_O_Data ) = 1
  and
    (
      p_TurmaOfe_Id is null
      or
      TurmaOfe.Id = nvl ( p_TurmaOfe_Id , 0)
    )
  and
    (
      p_DuracXCi_Sequencia is null
      or
      DuracXCi.Sequencia = nvl( p_DuracXCi_Sequencia , 0)
    )
  and
    (
      p_Periodo_Id is null
      or
      CurrOfe.Periodo_Id = nvl( p_Periodo_Id ,0)
    )
  and
    (
      p_Curso_Id is null
      or
      Curso.Id =  nvl( p_Curso_Id ,0)
    )
  and
    (
      p_Campus_Id is null
      or
      CurrOfe.Campus_Id  = nvl( p_Campus_Id ,0)
    )
  and
    (
      p_Facul_Id is null
      or
      Curso.Facul_Id  = nvl( p_Facul_Id ,0)
    )
  and
    HoraAula.WPessoa_Prof2_Id = nvl ( p_WPessoa_Id , 0 )
  union all
  select
    WPessoa_Prof3_Id         as WPessoa_Id,
    Horario.Semana_Id        as Semana_Id,
    to_char(Horario.HoraInicio,'HH24:MI') as Hora,
    curr.curso_id            as curso_id   
  from
    HoraAula,
    Horario,
    TurmaOfe,
    CurrOfe,
    TOXCD,
    Curr,
    WPessoa,
    Curso,
    Turma,
    DuracXCi,
    Facul
  where
    Curso.Facul_Id = Facul.Id
  and
    Horario.Id = HoraAula.Horario_Id
  and
    HoraAula.TOXCD_Id = TOXCD.ID
  and
    TOXCD.TurmaOfe_Id = TurmaOfe.Id
  and
    TurmaOfe.CurrOfe_Id = CurrOfe.Id
  and
    CurrOfe.Curr_Id = Curr.Id
  and
    WPessoa.Id = HoraAula.WPessoa_Prof3_Id
  and
    duracxci.id = turma.duracxci_id
  and
    turma.id = turmaofe.turma_id
  and
    Curr.Curso_Id = Curso.Id
  and
    Curso.CursoNivel_Id in ( 6200000000001,6200000000010 )
  and
    p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
  and
    Admissao_gnAtivo ( nvl ( WPessoa_Prof3_Id, 0 ) , p_O_Data ) = 1
  and
    (
      p_TurmaOfe_Id is null
      or
      TurmaOfe.Id = nvl ( p_TurmaOfe_Id , 0)
    )
  and
    (
      p_DuracXCi_Sequencia is null
      or
      DuracXCi.Sequencia = nvl( p_DuracXCi_Sequencia , 0)
    )
  and
    (
      p_Periodo_Id is null
      or
      CurrOfe.Periodo_Id = nvl( p_Periodo_Id ,0)
    )
  and
    (
      p_Curso_Id is null
      or
      Curso.Id =  nvl( p_Curso_Id ,0)
    )
  and
    (
      p_Campus_Id is null
      or
      CurrOfe.Campus_Id  = nvl( p_Campus_Id ,0)
    )
  and
    (
      p_Facul_Id is null
      or
      Curso.Facul_Id  = nvl( p_Facul_Id ,0)
    )
  and
    HoraAula.WPessoa_Prof3_Id = nvl ( p_WPessoa_Id , 0 )
  union all
  select
    WPessoa_Prof4_Id         as WPessoa_Id,
    Horario.Semana_Id        as Semana_Id,
    to_char(Horario.HoraInicio,'HH24:MI') as Hora,
    curr.curso_id            as curso_id   
  from
    HoraAula,
    Horario,
    TurmaOfe,
    CurrOfe,
    TOXCD,
    Curr,
    WPessoa,
    Curso,
    Turma,
    DuracXCi,
    Facul
  where
    Curso.Facul_Id = Facul.Id
  and
    Horario.Id = HoraAula.Horario_Id
  and
    HoraAula.TOXCD_Id = TOXCD.ID
  and
    TOXCD.TurmaOfe_Id = TurmaOfe.Id
  and
    TurmaOfe.CurrOfe_Id = CurrOfe.Id
  and
    CurrOfe.Curr_Id = Curr.Id
  and
    WPessoa.Id = HoraAula.WPessoa_Prof4_Id
  and
    duracxci.id = turma.duracxci_id
  and
    turma.id = turmaofe.turma_id
  and
    Curr.Curso_Id = Curso.Id
  and
    Curso.CursoNivel_Id in ( 6200000000001,6200000000010 )
  and
    p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
  and
    Admissao_gnAtivo ( nvl ( WPessoa_Prof4_Id, 0 ) , p_O_Data ) = 1
  and
    (
      p_TurmaOfe_Id is null
      or
      TurmaOfe.Id = nvl ( p_TurmaOfe_Id , 0)
    )
  and
    (
      p_DuracXCi_Sequencia is null
      or
      DuracXCi.Sequencia = nvl( p_DuracXCi_Sequencia , 0)
    )
  and
    (
      p_Periodo_Id is null
      or
      CurrOfe.Periodo_Id = nvl( p_Periodo_Id ,0)
    )
  and
    (
      p_Curso_Id is null
      or
      Curso.Id =  nvl( p_Curso_Id ,0)
    )
  and
    (
      p_Campus_Id is null
      or
      CurrOfe.Campus_Id  = nvl( p_Campus_Id ,0)
    )
  and
    (
      p_Facul_Id is null
      or
      Curso.Facul_Id  = nvl( p_Facul_Id ,0)
    )
  and
    HoraAula.WPessoa_Prof4_Id = nvl ( p_WPessoa_Id , 0 )
  union all
  select    
    WPessoa_Prof1_Id         as WPessoa_Id,
    Horario.Semana_Id        as Semana_Id,
    to_char(Horario.HoraInicio,'HH24:MI') as Hora,
    curso.id as curso_id
  from
    HoraAula,
    Horario,
    TurmaOfe,
    DiscEsp,
    TOXCD,
    WPessoa,
    Curso, 
    Turma,
    DuracXCi,
    AreaAcad,
    Facul
  where  
    Facul.Id = AreaAcad.Facul_Id
  and
    DiscEsp.AreaAcad_Id = AreaAcad.Id
  and
    Horario.Id = HoraAula.Horario_Id
  and
    HoraAula.TOXCD_Id = TOXCD.ID
  and
    TOXCD.TurmaOfe_Id = TurmaOfe.Id
  and
    TurmaOfe.DiscEsp_Id = DiscEsp.Id
  and
    WPessoa.Id = HoraAula.WPessoa_Prof1_Id
  and
    turma.id = turmaofe.turma_id
  and
    Turma.Curso_Id = Curso.Id
  and 
    p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
  and
    Admissao_gnAtivo ( nvl ( WPessoa_Prof1_Id, 0 ) , p_O_Data ) = 1
  and 
    (
      p_TurmaOfe_Id is null
      or
      TurmaOfe.Id = nvl ( p_TurmaOfe_Id , 0)
    )  
  and
    (
      p_Curso_Id is null
      or
      Curso.Id =  nvl( p_Curso_Id ,0)
    )
  and
    (
      p_Campus_Id is null
      or
      Turma.Campus_Id  = nvl(  p_Campus_Id ,0)
    ) 
  and
    (
      p_Facul_Id is null
      or
      AreaAcad.Facul_Id  = nvl(  p_Facul_Id ,0)
    )  
  and
    HoraAula.WPessoa_Prof1_Id = nvl ( p_WPessoa_Id , 0 )
) 
group by WPessoa_Id,Semana_id,Hora
having count(*) > 1