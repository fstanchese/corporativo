select
  WPessoa.Codigo ||' - '|| WPessoa.Nome ||' - '|| State_gsRecognize(Matric.State_Id) as Recognize,
  WPessoa.Id                         as Id,
  WPessoa.Codigo                     as RA,
  State_gsRecognize(Matric.State_Id) as Estado_Matric,
  Matric.TurmaOfe_Id                 as TurmaOfe_Id,       
  WPessoa.Nome                       as NomeAluno,
  shortname(WPessoa.Nome,27)         as NomeReduz,
  Matric.Id                          as Matric_Id,
  Matric.Data                        as DataMatricula,
  Matric.MatricTi_Id                 as MatricTi_Id,
  Matric.Matric_Pai_Id               as Matric_Pai_Id,
  Curr.Id                            as Curr_Id,
  Curr.Curso_Id                      as Curso_Id
from
  Curr,
  CurrOfe,
  TurmaOfe,
  Matric,
  WPessoa
where
  Matric.MatricTi_Id = 8300000000001
and
  Matric.State_Id > p_Matric_State_Id
and
  Matric.WPessoa_Id = WPessoa.Id
and
  Curr.Id = CurrOfe.Curr_Id
and
  CurrOfe.Id = TurmaOfe.CurrOfe_Id
and
  TurmaOfe.Id = Matric.TurmaOfe_Id
and
  Matric.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0)
and
  CurrOfe.PLetivo_Id  < p_PLetivo_Limite_Id
union
select
  WPessoa.Codigo ||' - '|| WPessoa.Nome ||' - '|| State_gsRecognize(Matric.State_Id) as Recognize,
  WPessoa.Id                         as Id,
  WPessoa.Codigo                     as RA,
  State_gsRecognize(Matric.State_Id) as Estado_Matric,
  Matric.TurmaOfe_Id                 as TurmaOfe_Id,       
  WPessoa.Nome                       as NomeAluno,
  shortname(WPessoa.Nome,27)         as NomeReduz,
  Matric.Id                          as Matric_Id,
  Matric.Data                        as DataMatricula,
  Matric.MatricTi_Id                 as MatricTi_Id,
  Matric.Matric_Pai_Id               as Matric_Pai_Id,
  Curr.Id                            as Curr_Id,
  Curr.Curso_Id                      as Curso_Id
from
  Curr,
  Matric,
  WPessoa,
  TurmaOfe,
  CurrOfe
where
  Matric.MatricTi_Id = 8300000000001
and
  Matric.State_Id > p_Matric_State_Id
and
  Matric.WPessoa_Id = WPessoa.Id
and
  TurmaOfe.Id = Matric.TurmaOfe_Id
and
  Curr.Id = CurrOfe.Curr_Id
and
  CurrOfe.Id = TurmaOfe.CurrOfe_Id
and
  Matric.WPessoa_Id = nvl ( p_WPessoa_Id , 0 )
and
  CurrOfe.Curr_Id = nvl ( p_Curr_Id , 0 )
and
  CurrOfe.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
order by NomeAluno,DataMatricula

