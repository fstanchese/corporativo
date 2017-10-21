select  
  Matric.Id                          as Id,
  WPessoa.Codigo                     as RA,
  WPessoa.RGRNE                      as RG,
  Estado_gsrecognize(Estado_RG_Id)   as Estado,
  State_gsRecognize(Matric.State_Id) as Estado_Matric,
  Matric.TurmaOfe_Id                 as TurmaOfe_Id,       
  WPessoa.Nome                       as NomeAluno,
  shortname(WPessoa.Nome,27)         as NomeReduz,
  WPessoa.Id                         as WPessoa_Id,
  Matric.DtState                     as DataState,
  Matric.Data                        as DataMatricula,
  Matric.MatricTi_Id                 as MatricTi_Id,
  Matric.Matric_Pai_Id               as Matric_Pai_Id,
  Matric.State_Id                    as State_Id,
  Matric.WPessoa_Id                  as WPessoa_Id,
  TurmaOfe_gsRetCodTurma(TurmaOfe_Id) as Turma,
  Curso.Id as Curso_Id
from   
  WPessoa,
  Curr,  
  Curso,  
  CurrOfe,  
  TurmaOfe,  
  Matric 
where  
  ( 
    trunc(Matric.DtState) between p_O_Data1 and p_O_Data2
    or
    ( p_O_Data1 is null and p_O_Data2 is null )
  )
and
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
  Matric.MatricTi_Id = 8300000000001 
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
  Matric.State_Id = nvl ( p_State_Id ,0)
and 
  (
    p_Curso_Id is null
    or
    Curso.Id = nvl ( p_Curso_Id , 0 )
  )
and
  CurrOfe.PLetivo_Id = nvl ( p_PLetivo_Id ,0 )
order by Curso.Nome,NomeAluno