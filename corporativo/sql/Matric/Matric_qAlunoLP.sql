select
  $p_O_Colunas
from
  (
    select
      distinct WPessoa.Id as WPessoa_Id,
      Curso.Id            as Curso_Id,
      TurmaOfe.Id         as TurmaOfe_Id,
      MatricTi_Id         as MatricTi_Id,
      DuracXCi.Sequencia  as Sequencia,
      Matric.Data         as DataMatric
    from
      Matric,
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
      Matric.TurmaOfe_Id = TurmaOfe.ID
    and
      TOXCD.TurmaOfe_Id = TurmaOfe.Id
    and
      TurmaOfe.CurrOfe_Id = CurrOfe.Id
    and
      CurrOfe.Curr_Id = Curr.Id
    and
      WPessoa.Id = Matric.WPessoa_Id
    and
      duracxci.id = turma.duracxci_id
    and
      turma.id = turmaofe.turma_id
    and
      Curr.Curso_Id = Curso.Id
    and
      Matric.MatricTi_Id = 8300000000001
    and
      Matric.State_Id = 3000000002002
    and
      (  
        wpessoa_gnParImpar(Matric.WPessoa_Id) = nvl( p_DivTurma_Id ,0)
        or
        nvl( p_DivTurma_Id ,0) = 13500000000016
      )
    and 
      (
        p_TurmaOfe_Id is null
        or
        TurmaOfe.Id = nvl ( p_TurmaOfe_Id , 0 )
      )
    and
      (
        p_DuracXCi_Sequencia is null
        or
        DuracXCi.Sequencia = nvl( p_DuracXCi_Sequencia , 0 )
      )  
    and
      (  
        p_Periodo_Id is null
        or
        CurrOfe.Periodo_Id = nvl( p_Periodo_Id ,0 )
      )
    and
      (
        p_Curso_Id is null
        or
        Curso.Id =  nvl( p_Curso_Id ,0 )
      )
    and
      (
        p_Campus_Id is null
        or
        CurrOfe.Campus_Id  = nvl(  p_Campus_Id ,0 )
      ) 
    and
      (
        p_TOXCD_Id is null
        or
        TOXCD.Id  = nvl(  p_TOXCD_Id ,0 )
      ) 
    and
      (
        p_Facul_Id is null
        or
        Curso.Facul_Id  = nvl(  p_Facul_Id ,0 )
      )
    and
      (
        p_WPessoa_Id is null
        or
        WPessoa.Id = nvl ( p_WPessoa_Id , 0 )
      )
    and
      CurrOfe.PLetivo_Id = nvl ( p_PLetivo_Id , 0 ) 
    union
    select
      distinct WPessoa.Id as WPessoa_Id,
      5700000000069       as Curso_Id,
      TurmaOfe.Id         as TurmaOfe_Id,
      MatricTi_Id         as MatricTi_Id,
      9                   as Sequencia,
      Matric.Data         as DataMatric
    from
      Matric,
      TurmaOfe,
      DiscEsp,
      TOXCD,
      WPessoa,
      Turma
    where  
      Matric.TurmaOfe_Id = TurmaOfe.Id
    and
      TOXCD.TurmaOfe_Id = TurmaOfe.Id
    and
      TurmaOfe.DiscEsp_Id = DiscEsp.Id
    and
      WPessoa.Id = Matric.WPessoa_Id
    and
      Turma.Id = turmaofe.turma_id
    and
      Matric.MatricTi_Id = 8300000000002
    and
      Matric.State_Id = 3000000002002
    and
      (  
        wpessoa_gnParImpar(Matric.WPessoa_Id) = nvl( p_DivTurma_Id ,0)
        or
        nvl( p_DivTurma_Id ,0) = 13500000000016
      )
    and 
      (
        p_TurmaOfe_Id is null
        or
        TurmaOfe.Id = nvl ( p_TurmaOfe_Id , 0 )
      )
    and
      (
        p_TOXCD_Id is null
        or
        TOXCD.Id  = nvl(  p_TOXCD_Id ,0 )
      ) 
    and
      (
        p_WPessoa_Id is null
        or
        WPessoa.Id = nvl ( p_WPessoa_Id , 0 )
      )
    and
      DiscEsp.PLetivo_Id = nvl ( p_PLetivo_Id , 0 ) 
  ) MATRIC,
  Curso
where
  Curso.Id = Matric.Curso_Id
group by $p_O_GroupBy
order by $p_O_OrderBy