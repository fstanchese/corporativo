select 
  MATRIC.* 
from
  (
    select  
      WPessoa.CPF                as CPF,
      WPessoa.Codigo             as RA,
      ShortName(WPessoa.Nome,27) as NomeAluno,
      WPessoa.Id                 as WPessoa_Id,
      Matric.MatricTi_Id         as MatricTi_Id,
      null                       as DiscEsp_Id
    from   
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
       (
       Matric.State_Id not in ( 3000000002000,3000000002001,3000000002004 )
       or
       ( Matric.State_Id = 3000000002004 and currofe.pletivo_id >= nvl ( p_PLetivo_Id , 0 ) )
       )
    and 
      (
        p_Curso_Id is null
        or
        Curso.Id = nvl ( p_Curso_Id , 0 )
      )
    and
      ( CurrOfe.PLetivo_Id >= 7200000000057 and CurrOfe.PLetivo_Id <= nvl ( p_PLetivo_Id ,0 ) )
    union
    select  
      WPessoa.CPF                as CPF,
      WPessoa.Codigo             as RA,
      ShortName(WPessoa.Nome,27) as NomeAluno,
      WPessoa.Id                 as WPessoa_Id,
      Matric.MatricTi_Id         as MatricTi_Id,
      DiscEsp.Id                 as DiscEsp_Id
    from
      matric,
      turmaofe,
      wpessoa,
      discesp
    where
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
      ( discesp.PLetivo_Id >= 7200000000057 and DiscEsp.PLetivo_Id <= nvl ( p_PLetivo_Id ,0 ) )
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
group by Cpf,RA,NomeAluno,WPessoa_Id,MatricTi_Id,DiscEsp_Id
order by NomeAluno
