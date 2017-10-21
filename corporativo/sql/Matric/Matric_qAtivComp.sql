select
  WPessoa.Codigo ||' - '|| WPessoa.Nome ||' - '|| State_gsRecognize(Matric.State_Id) as Recognize,
  Matric.Id                              as Id,
  WPessoa.Codigo                         as RA,
  State_gsRecognize(Matric.State_Id)     as Estado_Matric,
  Matric.TurmaOfe_Id                     as TurmaOfe_Id,       
  WPessoa.Nome                           as NomeAluno,
  shortname(WPessoa.Nome,27)             as NomeReduz,
  Matric.Id                              as Matric_Id,
  Matric.Data                            as DataMatricula,
  Matric.MatricTi_Id                     as MatricTi_Id,
  Matric.Matric_Pai_Id                   as Matric_Pai_Id,
  TurmaOfe_gnRetCurr(Matric.TurmaOfe_Id) as Curr_Id
from
  Matric,
  WPessoa
where
  Matric.State_Id in ( 3000000002002,3000000002003,3000000002012, 3000000002011, 3000000002010 )
and
  Matric.MatricTi_Id = 8300000000001
and
  Matric.WPessoa_Id = WPessoa.Id
and
  Matric.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0 )
order by NomeAluno,DataMatricula
