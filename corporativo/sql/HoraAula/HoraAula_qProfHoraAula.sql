select
  $p_O_Colunas
from
  (
    select
      WPessoa.Id                                             as WPessoa_Id,
      WPessoa.Class_Id                                       as Class_Id,
      WPessoa.RegTrab_Id                                     as RegTrab_Id,
      nvl(WPessoa_gnUltimoTitulo(WPessoa.Id),15600000000999) as Titulo_Id,
      Curso.Id                                               as Curso_Id,
      CurrXDisc_gsRetDisc(TOXCD.CurrXDisc_Id)                as Discip
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
     Curso.CursoNivel_Id not in ( 6200000000002,6200000000008 )
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
      (
        p_WPessoa_Id is null
        or
        HoraAula.WPessoa_Prof1_Id = nvl ( p_WPessoa_Id , 0 )
      )
   union 
    select
      WPessoa.Id                                             as WPessoa_Id,
      WPessoa.Class_Id                                       as Class_Id,
      WPessoa.RegTrab_Id                                     as RegTrab_Id,
      nvl(WPessoa_gnUltimoTitulo(WPessoa.Id),15600000000999) as Titulo_Id,
      Curso.Id                                               as Curso_Id,
      CurrXDisc_gsRetDisc(TOXCD.CurrXDisc_Id)                as Discip
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
     Curso.CursoNivel_Id not in ( 6200000000002,6200000000008 )
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
      (
        p_WPessoa_Id is null
        or
        HoraAula.WPessoa_Prof2_Id = nvl ( p_WPessoa_Id , 0 )
      )
   union 
    select
      WPessoa.Id                                             as WPessoa_Id,
      WPessoa.Class_Id                                       as Class_Id,
      WPessoa.RegTrab_Id                                     as RegTrab_Id,
      nvl(WPessoa_gnUltimoTitulo(WPessoa.Id),15600000000999) as Titulo_Id,
      Curso.Id                                               as Curso_Id,
      CurrXDisc_gsRetDisc(TOXCD.CurrXDisc_Id)                as Discip
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
     Curso.CursoNivel_Id not in ( 6200000000002,6200000000008 )
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
      (
        p_WPessoa_Id is null
        or
        HoraAula.WPessoa_Prof3_Id = nvl ( p_WPessoa_Id , 0 )
      )
   union 
    select
      WPessoa.Id                                             as WPessoa_Id,
      WPessoa.Class_Id                                       as Class_Id,
      WPessoa.RegTrab_Id                                     as RegTrab_Id,
      nvl(WPessoa_gnUltimoTitulo(WPessoa.Id),15600000000999) as Titulo_Id,
      Curso.Id                                               as Curso_Id,
      CurrXDisc_gsRetDisc(TOXCD.CurrXDisc_Id)                as Discip
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
     Curso.CursoNivel_Id not in ( 6200000000002,6200000000008 )
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
      (
        p_WPessoa_Id is null
        or
        HoraAula.WPessoa_Prof4_Id = nvl ( p_WPessoa_Id , 0 )
      )
   union 
    select
      WPessoa.Id                                             as WPessoa_Id,
      WPessoa.Class_Id                                       as Class_Id,
      WPessoa.RegTrab_Id                                     as RegTrab_Id,
      nvl(WPessoa_gnUltimoTitulo(WPessoa.Id),15600000000999) as Titulo_Id,
      Curso.Id                                               as Curso_Id,
      DiscEsp.Nome                                           as Discip
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
     (
        p_WPessoa_Id is null
        or
        HoraAula.WPessoa_Prof1_Id = nvl ( p_WPessoa_Id , 0 )
      )    
  ) 
where
  (
    p_Class_Id is null
    or
    Class_Id = nvl ( p_Class_Id , 0)
  )
and
  (
    p_RegTrab_Id is null
    or 
    RegTrab_Id = nvl ( p_RegTrab_Id , 0)
  )
group by $p_O_GroupBy
order by $p_O_OrderBy