select  
  WPessoa.CPF                         as CPF,
  Matric.Id                           as Matric_Id,
  WPessoa.Codigo                      as RA,
  State_gsRecognize(Matric.State_Id)  as Estado_Matric,
  Matric.TurmaOfe_Id                  as TurmaOfe_Id,       
  WPessoa.Nome                        as NomeAluno,
  shortname(WPessoa.Nome,27)          as NomeReduz,
  WPessoa.Id                          as WPessoa_Id,
  Matric.DtState                      as DataState,
  Matric.Data                         as DataMatricula,
  Matric.MatricTi_Id                  as MatricTi_Id,
  Matric.Matric_Pai_Id                as Matric_Pai_Id,
  Matric.State_Id                     as State_Id,
  TurmaOfe_gsRetCodTurma(TurmaOfe_Id) as Turma,
  Curso.Id                            as Curso_Id,
  Curso.Nome                          as CursoNome,
  state.nome                          as state_nome,
  Decode(TurmaOfe_gnUltimoAnista(TurmaOfe.Id),1,'C','') as Concluinte
from
  Turma,   
  State,
  WPessoa,
  Curr,  
  Curso,  
  CurrOfe,  
  TurmaOfe,
  Matric 
where
  exists (
          Select
            Matric.id 
          from 
            Matric,
            Curr,
            Curso,
            TurmaOfe,
            CurrOfe
          Where
            WPessoa.id = Matric.WPessoa_Id
          and
            Matric.State_Id < 3000000002002
          and
            Matric.MatricTi_Id = 8300000000001
          and  
            Matric.TurmaOfe_Id = TurmaOfe.Id 
          and  
            (
              p_CursoNivel_Id is null
            or
              Curso.CursoNivel_Id = nvl ( p_CursoNivel_Id , 0 )
            )  
          and
            Curso.Id = Curr.Curso_Id 
          and  
            Curr.Id = CurrOfe.Curr_Id 
          and
            CurrOfe.Id = TurmaOfe.CurrOfe_Id 
          and
            CurrOfe.PLetivo_Id = nvl ( p_PLetivo_Posterior_Id ,0 )
          )                
and 
  Matric.WPessoa_Id = WPessoa.Id 
and
  Matric.State_Id in ( 3000000002002, 3000000002003, 3000000002005, 3000000002010, 3000000002011, 3000000002014)
and
  Matric.MatricTi_Id = 8300000000001
and
  Matric.State_Id = State.Id
and
  Matric.TurmaOfe_Id = TurmaOfe.Id 
and
  (
    p_CursoNivel_Id is null
  or
    Curso.CursoNivel_Id = nvl ( p_CursoNivel_Id , 0 )
  )  
and
  (
    p_Curso_Id is null
  or
    Curso.Id = nvl ( p_Curso_Id , 0 )
  )
and  
  Curso.Id = Curr.Curso_Id 
and  
  Curr.Id = CurrOfe.Curr_Id 
and  
  CurrOfe.Id = TurmaOfe.CurrOfe_Id 
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
  CurrOfe.PLetivo_Id = nvl ( p_PLetivo_Id ,0 )
order by $p_O_OrderBy