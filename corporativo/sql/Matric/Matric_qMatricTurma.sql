select
  WPessoa.Codigo ||' - '|| WPessoa.Nome ||' - '|| State_gsRecognize(Matric.State_Id) as Recognize,
  Matric.Id                          as Id,
  WPessoa.Codigo                     as RA,
  State_gsRecognize(Matric.State_Id) as Estado_Matric,
  Matric.TurmaOfe_Id                 as TurmaOfe_Id,       
  WPessoa.Nome                       as NomeAluno,
  shortname(WPessoa.Nome,27)         as NomeReduz,
  WPessoa.Id                         as WPessoa_Id,
  Matric.Data                        as DataMatricula,
  Matric.MatricTi_Id                 as MatricTi_Id,
  Matric.Matric_Pai_Id               as Matric_Pai_Id,
  TurmaOfe_gnRetCurr(TurmaOfe_Id)    as Curr_Id,
  turmaofe_gsretcodturma(turmaofe.id) as Turma
from
  Matric,
  WPessoa,
  TurmaOfe,
  Curr,
  CurrOfe
where
  Matric.MatricTi_Id = 8300000000001
and
  Matric.State_Id in ( 3000000002002,3000000002003,3000000002010,3000000002011,3000000002012 )
and
  Matric.WPessoa_Id = WPessoa.Id
and
  CurrOfe.Curr_Id = Curr.Id
and  
  (
    p_Curso_Id is null
      or
    Curr.Curso_Id = nvl( p_Curso_Id , 0)
  )
and
  ( 
     p_WPessoa_Id is null
      or
     Matric.WPessoa_Id = nvl ( p_WPessoa_Id , 0 )
  )  
and
  Matric.TurmaOfe_Id = TurmaOfe.Id
and
  (
    p_TurmaOfe_Id is null
      or 
    TurmaOfe.Id = nvl( p_TurmaOfe_Id ,0 )
  )
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  CurrOfe.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
order by 6
