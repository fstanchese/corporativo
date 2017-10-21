select
  count(*) as CountAulas
from
  (
    select
      WPessoa_Prof1_Id         as WPessoa_Id,
      Horario.Semana_Id        as Semana_Id,
      to_char(Horario.HoraInicio,'HH24:MI') as Hora
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
      nvl(HoraAula.CustoZero,'off')='off'
    and
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
      Curso.CursoNivel_Id not in ( 6200000000002,6200000000008 )
    and
      (
        Turma.TurmaTi_Id = nvl ( p_TurmaTi_Id , 0 )
        or 
        p_TurmaTi_Id is null
      ) 
    and
      (
        Horario.Sequencia = nvl ( p_Horario_Sequencia , 0 )
        or 
       p_Horario_Sequencia is null
      )
    and
      (
        to_char(horainicio,'hh24:mi') = nvl ( p_Horario_HoraInicioTxt , 0 )
        or 
        p_Horario_HoraInicioTxt is null
      )
    and
      (  
        nvl(HoraAula.CustoZero,'off') = p_HoraAula_CustoZero
        or
        p_HoraAula_CustoZero is null      
      )
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
        CurrOfe.Campus_Id  = nvl(  p_Campus_Id ,0)
      ) 
    and
      (
        p_Facul_Id is null
        or
        Curso.Facul_Id  = nvl(  p_Facul_Id ,0)
      )
    and
      HoraAula.WPessoa_Prof1_Id = nvl ( p_WPessoa_Id , 0 )
    group by WPessoa_Prof1_Id,Horario.Semana_Id,HoraInicio
  union 
    select
      WPessoa_Prof2_Id         as WPessoa_Id,
      Horario.Semana_Id        as Semana_Id,
      to_char(Horario.HoraInicio,'HH24:MI') as Hora
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
      nvl(HoraAula.CustoZero,'off')='off'
    and
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
      Curso.CursoNivel_Id not in ( 6200000000002,6200000000008 )
    and
      (
        Turma.TurmaTi_Id = nvl ( p_TurmaTi_Id , 0 )
        or 
        p_TurmaTi_Id is null
      ) 
    and
      (
        Horario.Sequencia = nvl ( p_Horario_Sequencia , 0 )
        or 
        p_Horario_Sequencia is null
      )
    and
      (
        to_char(horainicio,'hh24:mi') = nvl ( p_Horario_HoraInicioTxt , 0 )
        or 
        p_Horario_HoraInicioTxt is null
      )
    and
      (  
        nvl(HoraAula.CustoZero,'off') = p_HoraAula_CustoZero
        or
        p_HoraAula_CustoZero is null      
      )
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
        CurrOfe.Campus_Id  = nvl(  p_Campus_Id ,0)
      ) 
    and
      (
        p_Facul_Id is null
        or
        Curso.Facul_Id  = nvl(  p_Facul_Id ,0)
      )
    and
      HoraAula.WPessoa_Prof2_Id = nvl ( p_WPessoa_Id , 0 )
    group by WPessoa_Prof2_Id,Horario.Semana_Id,HoraInicio
    union 
    select
      WPessoa_Prof3_Id         as WPessoa_Id,
      Horario.Semana_Id        as Semana_Id,
      to_char(Horario.HoraInicio,'HH24:MI') as Hora
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
      nvl(HoraAula.CustoZero,'off')='off'
    and
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
      Curso.CursoNivel_Id not in ( 6200000000002,6200000000008 )
    and
      (
        Turma.TurmaTi_Id = nvl ( p_TurmaTi_Id , 0 )
        or 
        p_TurmaTi_Id is null
      ) 
    and
      (
        Horario.Sequencia = nvl ( p_Horario_Sequencia , 0 )
        or 
       p_Horario_Sequencia is null
      )
    and
      (
        to_char(horainicio,'hh24:mi') = nvl ( p_Horario_HoraInicioTxt , 0 )
        or 
        p_Horario_HoraInicioTxt is null
      )
    and
      (  
        nvl(HoraAula.CustoZero,'off') = p_HoraAula_CustoZero
        or
        p_HoraAula_CustoZero is null      
      )
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
        CurrOfe.Campus_Id  = nvl(  p_Campus_Id ,0)
      ) 
    and
      (
        p_Facul_Id is null
        or
        Curso.Facul_Id  = nvl(  p_Facul_Id ,0)
      )
    and
      HoraAula.WPessoa_Prof3_Id = nvl ( p_WPessoa_Id , 0 )
    group by WPessoa_Prof3_Id,Horario.Semana_Id,HoraInicio
    union 
    select
      WPessoa_Prof4_Id         as WPessoa_Id,
      Horario.Semana_Id        as Semana_Id,
      to_char(Horario.HoraInicio,'HH24:MI') as Hora
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
      nvl(HoraAula.CustoZero,'off')='off'
    and
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
      Curso.CursoNivel_Id not in ( 6200000000002,6200000000008 )
    and
      (
        Turma.TurmaTi_Id = nvl ( p_TurmaTi_Id , 0 )
        or 
        p_TurmaTi_Id is null
      ) 
    and
      (
        Horario.Sequencia = nvl ( p_Horario_Sequencia , 0 )
        or 
        p_Horario_Sequencia is null
      )
    and
      (
        to_char(horainicio,'hh24:mi') = nvl ( p_Horario_HoraInicioTxt , 0 )
        or 
        p_Horario_HoraInicioTxt is null
      )
    and
      (  
        nvl(HoraAula.CustoZero,'off') = p_HoraAula_CustoZero
        or
        p_HoraAula_CustoZero is null      
      )
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
        CurrOfe.Campus_Id  = nvl(  p_Campus_Id ,0)
      ) 
    and
      (
        p_Facul_Id is null
        or
        Curso.Facul_Id  = nvl(  p_Facul_Id ,0)
      )
    and
      HoraAula.WPessoa_Prof4_Id = nvl ( p_WPessoa_Id , 0 )
    group by WPessoa_Prof4_Id,Horario.Semana_Id,HoraInicio
    union 
    select
      WPessoa_Prof1_Id         as WPessoa_Id,
      Horario.Semana_Id        as Semana_Id,
      to_char(Horario.HoraInicio,'HH24:MI') as Hora
    from
      Horario,
      HoraAula,
      WPessoa,
      TOXCD,
      TurmaOfe,
      Turma,
      DiscEsp,
      Curso,
      AreaAcad,
      Facul  
    where
      nvl(HoraAula.CustoZero,'off')='off'
    and
      Facul.Id = AreaAcad.Facul_Id
    and
      DiscEsp.AreaAcad_Id = AreaAcad.Id
    and 
      HoraAula.Horario_Id = Horario.Id
    and
      Turma.Curso_Id = Curso.Id
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
        nvl(HoraAula.CustoZero,'off') = p_HoraAula_CustoZero
        or
        p_HoraAula_CustoZero is null      
      )
    and
      (
        p_Curso_Id is null
        or
        Curso.Id =  nvl( p_Curso_Id ,0)
      )
    and
      (
         p_TurmaOfe_Id is null
         or
         TurmaOfe.Id = nvl ( p_TurmaOfe_Id , 0 )
      )
    and
      (
         p_HoraAula_CustoZero is null
         or
         nvl( HoraAula.CustoZero, 'off' ) = p_HoraAula_CustoZero
      )
    and
      (
        AreaAcad.Facul_Id = nvl ( p_Facul_Id , 0 )
        or
        p_Facul_Id is null
      )
    and
      (
        Turma.Campus_Id = nvl ( p_Campus_Id , 0 )
        or
        p_Campus_Id is null
      )
    and
      Admissao_gnAtivo ( nvl ( WPessoa_Prof1_Id, 0 ) , p_O_Data ) = 1
    and
      p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino
    and
      HoraAula.WPessoa_Prof1_Id = nvl ( p_WPessoa_Id ,0 )
    group by WPessoa_Prof1_Id,Horario.Semana_Id,HoraInicio
    union
    select
      ProfExercMag.WPessoa_Id               as WPessoa_Id, 
      PEMagXHor.Id                          as Semana_Id,
      to_char(Horario.HoraInicio,'HH24:MI') as Hora
    from
      Horario,
      PEMagXHor,
      ProfExercMag,
      WPessoa,
      Atividade,
      Curso  
    where
      (
        p_Campus_Id is null
        or 
        nvl ( p_Campus_Id , 0 ) = 6400000000001
      )
    and
      p_O_Data between ProfExercMag.Inicio and ProfExercMag.Fim
    and 
      PEMagXHor.Horario_Id = Horario.Id
    and
      PEMagXHor.ProfExercMag_Id = ProfExercMag.Id
    and
      ProfExercMag.WPessoa_Id = WPessoa.Id
    and
      ProfExercMag.Curso_Id = Curso.Id (+)
    and
      ProfExercMag.Atividade_Id = Atividade.Id
    and
      Atividade.AtividaTi_Id = 14600000000003
    and
      Admissao_gnAtivo ( ProfExercMag.WPessoa_Id , p_O_Data ) = 1
    and
      (
        p_Curso_Id is null
        or
        Curso.Id =  nvl( p_Curso_Id ,0)
      )
    and
      (
        p_WPessoa_Id is null
        or
        ProfExercMag.WPessoa_Id = nvl ( p_WPessoa_Id , 0 )
      )
    and 
      (
        p_Dedicacao is null
        or
        p_Dedicacao = 'on' 
      )
  ) 