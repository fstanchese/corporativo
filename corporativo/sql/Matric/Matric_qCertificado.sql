select
  WPessoa.Codigo ||' - '|| WPessoa.Nome ||' - '|| State_gsRecognize(Matric.State_Id) as Recognize,
  Matric.Id                          as Id,
  WPessoa.Codigo                     as RA,
  State_gsRecognize(Matric.State_Id) as Estado_Matric,
  Matric.TurmaOfe_Id                 as TurmaOfe_Id,       
  WPessoa.Nome                       as NomeAluno,
  shortname(WPessoa.Nome,27)         as NomeReduz,
  Matric.Id                          as Matric_Id,
  Matric.Data                        as DataMatricula,
  Matric.MatricTi_Id                 as MatricTi_Id,
  Matric.Matric_Pai_Id               as Matric_Pai_Id,
  TurmaOfe_gnRetCurr(Matric.TurmaOfe_Id) as Curr_Id
from
  Matric,
  WPessoa
where
  Matric.MatricTi_Id = 8300000000001
and
  Matric.State_Id = 3000000002012
and
  Matric.WPessoa_Id = WPessoa.Id
and
  Matric.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0 )
union
select
  WPessoa.Codigo ||' - '|| WPessoa.Nome ||' - '|| State_gsRecognize(Matric.State_Id) as Recognize,
  Matric.Id                          as Id,
  WPessoa.Codigo                     as RA,
  State_gsRecognize(Matric.State_Id) as Estado_Matric,
  Matric.TurmaOfe_Id                 as TurmaOfe_Id,       
  WPessoa.Nome                       as NomeAluno,
  shortname(WPessoa.Nome,27)         as NomeReduz,
  Matric.Id                          as Matric_Id,
  Matric.Data                        as DataMatricula,
  Matric.MatricTi_Id                 as MatricTi_Id,
  Matric.Matric_Pai_Id               as Matric_Pai_Id,
  TurmaOfe_gnRetCurr(Matric.TurmaOfe_Id) as Curr_Id
from
  Matric,
  WPessoa
where
  TurmaOfe_gnRetPletivo( TurmaOfe_Id ) = nvl ( p_PLetivo_Id , 0 )
and
  TurmaOfe_gnRetCurr( TurmaOfe_Id ) = nvl ( p_Curr_Id , 0 )
and
  Matric.MatricTi_Id = 8300000000001
and
  Matric.State_Id = 3000000002012
and
  Matric.WPessoa_Id = WPessoa.Id
and
  Matric.WPessoa_Id = nvl ( p_WPessoa_Id , 0 )
order by NomeAluno,DataMatricula

