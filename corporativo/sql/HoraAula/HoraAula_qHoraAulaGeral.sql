( 
  select 
    HoraAula.WPessoa_Prof1_Id                                                as WPessoa_Id, 
    WPessoa_gsRecognize( HoraAula.WPessoa_Prof1_Id)                          as Professor, 
    RegTrab_gsRecognize( wpessoa_gnregtrab(  WPessoa_Prof1_Id , p_O_Data ) ) as RegTrab,
    Class_gsRecognize( wpessoa_gnclass(  WPessoa_Prof1_Id , p_O_Data ) )     as Classificacao,
    wpessoa_gnregtrab(  WPessoa_Prof1_Id , p_O_Data )                        as RegTrab_Id,
    wpessoa_gnclass(  WPessoa_Prof1_Id , p_O_Data )                          as Class_Id
  from 
    HoraAula, 
    TOXCD, 
    TurmaOfe, 
    Turma, 
    Curso
  where 
    Turma.Curso_Id = Curso.Id 
  and 
    TurmaOfe.Turma_Id = Turma.Id 
  and 
    TOXCD.TurmaOfe_Id = TurmaOfe.Id 
  and 
    HoraAula.TOXCD_Id = TOXCD.Id 
  and 
    HoraAula.WPessoa_Prof1_Id is not null
  and
    admissao_gnAtivo ( nvl ( WPessoa_Prof1_Id, 0 ) , p_O_Data ) = 1
  and
    p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino 
  and
    (
      p_WPessoa_Id is null
      or
      WPessoa_Prof1_Id = nvl ( p_WPessoa_Id ,0 )
    )
  group by 
    HoraAula.WPessoa_Prof1_Id,Curso.Id,Turma.Campus_Id
)  
union 
( 
  select 
    HoraAula.WPessoa_Prof2_Id                                                             as WPessoa_Id, 
    WPessoa_gsRecognize( HoraAula.WPessoa_Prof2_Id)                                       as Professor, 
    RegTrab_gsRecognize( wpessoa_gnregtrab(  WPessoa_Prof2_Id , p_O_Data ) )              as RegTrab,
    Class_gsRecognize( wpessoa_gnclass(  WPessoa_Prof2_Id , p_O_Data ) )                  as Classificacao,
    wpessoa_gnregtrab(  WPessoa_Prof2_Id , p_O_Data )                        as RegTrab_Id,
    wpessoa_gnclass(  WPessoa_Prof2_Id , p_O_Data )                          as Class_Id
  from 
    HoraAula, 
    TOXCD, 
    TurmaOfe, 
    Turma, 
    Curso
  where 
    Turma.Curso_Id = Curso.Id 
  and 
    TurmaOfe.Turma_Id = Turma.Id 
  and 
    TOXCD.TurmaOfe_Id = TurmaOfe.Id 
  and 
    HoraAula.TOXCD_Id = TOXCD.Id 
  and 
    HoraAula.WPessoa_Prof2_Id is not null 
  and
    admissao_gnAtivo ( nvl ( WPessoa_Prof2_Id, 0 ) , p_O_Data ) = 1
  and 
    p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino 
  and
    (
      p_WPessoa_Id is null
      or
      WPessoa_Prof2_Id = nvl ( p_WPessoa_Id ,0 )
    )
  group by 
    HoraAula.WPessoa_Prof2_Id,Curso.Id,Turma.Campus_Id
)  
union 
( 
  select 
    HoraAula.WPessoa_Prof3_Id                                                             as WPessoa_Id, 
    WPessoa_gsRecognize( HoraAula.WPessoa_Prof3_Id)                                       as Professor, 
    RegTrab_gsRecognize( wpessoa_gnregtrab(  WPessoa_Prof3_Id , p_O_Data ) )              as RegTrab,
    Class_gsRecognize( wpessoa_gnclass(  WPessoa_Prof3_Id , p_O_Data ) )                  as Classificacao,
    wpessoa_gnregtrab(  WPessoa_Prof3_Id , p_O_Data )                        as RegTrab_Id,
    wpessoa_gnclass(  WPessoa_Prof3_Id , p_O_Data )                          as Class_Id
  from 
    HoraAula, 
    TOXCD, 
    TurmaOfe, 
    Turma, 
    Curso
  where 
    Turma.Curso_Id = Curso.Id 
  and 
    TurmaOfe.Turma_Id = Turma.Id 
  and 
    TOXCD.TurmaOfe_Id = TurmaOfe.Id 
  and 
    HoraAula.TOXCD_Id = TOXCD.Id 
  and 
    HoraAula.WPessoa_Prof3_Id is not null 
  and
    admissao_gnAtivo ( nvl ( WPessoa_Prof3_Id, 0 ) , p_O_Data ) = 1
  and 
    p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino 
  and
    (
      p_WPessoa_Id is null
      or
      WPessoa_Prof3_Id = nvl ( p_WPessoa_Id ,0 )
    )
  group by 
    HoraAula.WPessoa_Prof3_Id,Curso.Id,Turma.Campus_Id
)  
union 
( 
  select 
    HoraAula.WPessoa_Prof4_Id                                                             as WPessoa_Id, 
    WPessoa_gsRecognize( HoraAula.WPessoa_Prof4_Id)                                       as Professor, 
    RegTrab_gsRecognize( wpessoa_gnregtrab(  WPessoa_Prof4_Id , p_O_Data ) )              as RegTrab,
    Class_gsRecognize( wpessoa_gnclass(  WPessoa_Prof4_Id , p_O_Data ) )                  as Classificacao,
    wpessoa_gnregtrab(  WPessoa_Prof4_Id , p_O_Data )                        as RegTrab_Id,
    wpessoa_gnclass(  WPessoa_Prof4_Id , p_O_Data )                          as Class_Id
  from 
    HoraAula, 
    TOXCD, 
    TurmaOfe, 
    Turma, 
    Curso
  where 
    Turma.Curso_Id = Curso.Id 
  and 
    TurmaOfe.Turma_Id = Turma.Id 
  and 
    TOXCD.TurmaOfe_Id = TurmaOfe.Id 
  and 
    HoraAula.TOXCD_Id = TOXCD.Id 
  and 
    HoraAula.WPessoa_Prof4_Id is not null
  and
    admissao_gnAtivo ( nvl ( WPessoa_Prof4_Id, 0 ) , p_O_Data ) = 1
  and 
    p_O_Data between HoraAula.DtInicio and HoraAula.DtTermino 
  and
    (
      p_WPessoa_Id is null
      or
      WPessoa_Prof4_Id = nvl ( p_WPessoa_Id ,0 )
    )
  group by    
    HoraAula.WPessoa_Prof4_Id,Curso.Id,Turma.Campus_Id
) 
union 
( 
  select 
    ProfExercMag.WPessoa_Id                                                               as WPessoa_Id, 
    WPessoa_gsRecognize(ProfExercMag.WPessoa_Id)                                          as Professor, 
    RegTrab_gsRecognize( wpessoa_gnregtrab(  ProfExercMag.WPessoa_Id , p_O_Data ) )       as RegTrab,
    Class_gsRecognize( wpessoa_gnclass(  ProfExercMag.WPessoa_Id , p_O_Data ) )           as Classificacao,
    wpessoa_gnregtrab(  ProfExercMag.WPessoa_Id , p_O_Data )                        as RegTrab_Id,
    wpessoa_gnclass(  ProfExercMag.WPessoa_Id , p_O_Data )                          as Class_Id
  from 
    ProfExercMag, 
    Atividade, 
    CCusto
  where 
    p_O_Data between ProfExercMag.Inicio and ProfExercMag.Fim 
  and
    ProfExercMag.CCusto_Id = CCusto.Id  
  and 
    Atividade.Id = ProfExercMag.Atividade_Id 
  and 
    Atividade.Atividati_Id = 14600000000003 
  and
    admissao_gnAtivo ( nvl ( ProfExercMag.WPessoa_Id, 0 ) , p_O_Data ) = 1
  and
    (
      p_WPessoa_Id is null
      or
      ProfExercMag.WPessoa_Id = nvl ( p_WPessoa_Id ,0 )
    )
  group by 
    profExercMag.WPessoa_Id,ProfExercMag.Curso_Id,Atividade.Nome,ProfExercMag.Id,CCusto.Id,CCusto.Codigo
)
union 
( 
  select 
    WPessoa.Id                                                          as WPessoa_Id, 
    WPessoa_gsRecognize(WPessoa.Id)                                     as Professor, 
    RegTrab_gsRecognize( wpessoa_gnregtrab(  WPessoa.Id , p_O_Data ) )  as RegTrab, 
    Class_gsRecognize( wpessoa_gnclass(  WPessoa.Id , p_O_Data ) )      as Classificacao,
    wpessoa_gnregtrab(  WPessoa.Id , p_O_Data )                        as RegTrab_Id,
    wpessoa_gnclass( WPessoa.Id , p_O_Data )                          as Class_Id
  from 
    WPessoa, 
    Cargo, 
    CargoXCCusto,
    CCusto,
    WPesXCargo
  where
    p_O_Data  >= trunc(WPesXCargo.DtCargo)
  and
    (
      p_O_Data <= trunc(WPesXCargo.DtTermino)
    or
      WPesXCargo.DtTermino is null
    )  
  and
    CargoXCCusto.CCusto_Id = CCusto.Id (+)
  and
    CargoXCCusto.Cargo_Id = Cargo.Id
  and 
    wpessoa.id = wpesxcargo.wpessoa_id 
  and 
    wpesxcargo.cargo_id = cargo.id 
  and 
    cargo.membroadm = 'on' 
  and
    (
      p_WPessoa_Id is null
      or
      WPessoa.Id = nvl ( p_WPessoa_Id ,0 )
    )
)
order by 2
