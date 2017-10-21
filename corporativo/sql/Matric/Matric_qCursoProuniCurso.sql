select 
  MATRIC.* 
from
  (
    select  
      WPessoa.CPF                         as CPF,
      Matric.Id                           as Matric_Id,
      WPessoa.Codigo                      as RA,
      State_gsRecognize(Matric.State_Id)  as Estado_Matric,
      Matric.TurmaOfe_Id                  as TurmaOfe_Id,       
      shortname(WPessoa.Nome,27)          as NomeAluno,
      shortname(WPessoa.Nome,27)          as NomeReduz,
      WPessoa.Id                          as WPessoa_Id,
      Matric.DtState                      as DataState,
      Matric.Data                         as DataMatricula,
      Matric.MatricTi_Id                  as MatricTi_Id,
      Matric.Matric_Pai_Id                as Matric_Pai_Id,
      Matric.State_Id                     as State_Id,
      TurmaOfe_gsRetCodTurma(TurmaOfe_Id) as Turma,
      Curso.Id   as Curso_Id,
      Curso.Nome as CursoNome,
      state.nome as state_nome,
      Decode(TurmaOfe_gnUltimoAnista(TurmaOfe.Id),1,'C','') as Concluinte,
      TurmaOfe_gnRetDiscEsp(Matric.TurmaOfe_Id) as DiscEsp_Id
    from   
      State,
      WPessoa,
      Curr,  
      Curso,  
      CurrOfe,  
      TurmaOfe,
      Matric 
    where  
      Matric.WPessoa_Id = WPessoa.Id 
    and
      Curso.Id = Curr.Curso_Id 
    and  
      Curr.Id = CurrOfe.Curr_Id 
    and  
      CurrOfe.Id = TurmaOfe.CurrOfe_Id 
    and  
      Matric.TurmaOfe_Id = TurmaOfe.Id 
    and
      (
        p_Campus_Id is null
        or
        CurrOfe.Campus_Id = nvl( p_Campus_Id ,0)
      )
    and
      ( 
        p_Periodo_Id is null
        or
        CurrOfe.Periodo_Id = nvl( p_Periodo_Id ,0)
      )
    and
      Matric.State_Id not in ( 3000000002000,3000000002001 )
    and
      Matric.State_Id = State.Id
    and 
      (
        p_Curso_Id is null
        or
        Curso.Id = nvl ( p_Curso_Id , 0 )
      )
    and
      CurrOfe.PLetivo_Id = nvl ( p_PLetivo_Id ,0 )
    union
    select  
      WPessoa.CPF                         as CPF,
      Matric.Id                           as Matric_Id,
      WPessoa.Codigo                      as RA,
      State_gsRecognize(Matric.State_Id)  as Estado_Matric,
      Matric.TurmaOfe_Id                  as TurmaOfe_Id,       
      shortname(WPessoa.Nome,27)          as NomeAluno,
      shortname(WPessoa.Nome,27)          as NomeReduz,
      WPessoa.Id                          as WPessoa_Id,
      Matric.DtState                      as DataState,
      Matric.Data                         as DataMatricula,
      Matric.MatricTi_Id                  as MatricTi_Id,
      Matric.Matric_Pai_Id                as Matric_Pai_Id,
      Matric.State_Id                     as State_Id,
      TurmaOfe_gsRetCodTurma(TurmaOfe_Id) as Turma,
      5700000003177                       as Curso_Id,
      'Formação de Professores'           as CursoNome,
      state.nome                          as state_nome,
      '' as Concluinte,
      TurmaOfe_gnRetDiscEsp(Matric.TurmaOfe_Id) as DiscEsp_Id
    from
      matric,
      turmaofe,
      wpessoa,
      discesp, 
      state  
    where
      state.id = matric.state_id
    and
      matric.state_id not in ( 3000000002007,3000000002008,3000000002009 )
    and
      wpessoa.id = matric.wpessoa_id
    and
      turmaofe.id = matric.turmaofe_id
    and
      discesp.id = turmaofe.discesp_id
    and
      discesp.discespti_id = 17800000000003
    and
      discesp.pletivo_id = nvl( p_PLetivo_Id ,0)
    and
      nvl( p_Curso_Id , 0 ) = 5700000003177
  ) MATRIC,
  DiscEsp
where
  DiscEsp.Id (+)= MATRIC.DiscEsp_Id
and
  (  
   ( DiscEsp.DiscEspTi_Id Is null and Matric.MatricTi_Id <> 8300000000002 )
   or
   ( DiscEsp.DiscEspTi_Id is not null and DiscEsp.DiscEspTi_Id = 17800000000003 )
  )
order by $p_O_OrderBy
